<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\drop_point;
use App\Models\country;
use App\Models\city;
use App\Models\shipment_category;
use App\Models\package_category;
use App\Models\manage_address;
use App\Models\shipment;
use App\Models\shipment_package;
use App\Models\shipment_notification;
use App\Models\User;
use App\Models\add_rate;
use App\Models\add_rate_item;
use App\Models\station;
use App\Models\agent;
use App\Models\settings;
use App\Models\language;
use App\Models\temp_shipment;
use App\Models\temp_shipment_package;
use App\Models\system_logs;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use PDF;

class PendingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function getClientIP():string
    {
        $keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
        foreach($keys as $k)
        {
            if (!empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP))
            {
                return $_SERVER[$k];
            }
        }
        return "UNKNOWN";
    }

    public function PendingShipment(){
        $language = language::all();
        return view('user.pending_shipment',compact('language'));
    }

    public function deletePendingShipment($id)
    {
        try{
            $temp_shipment_delete = temp_shipment::find($id);
            $temp_shipment_delete->delete();

            temp_shipment_package::where('temp_id', $id)->delete();

            return response()->json(
            ['message' => 'Delete Successfully'],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        }
    }

    public function getPendingShipment(){
        $shipment = temp_shipment::where('sender_id',Auth::user()->id)->orderBy('id', 'DESC')->get();

        return Datatables::of($shipment)
            ->addColumn('checkbox', function ($shipment) {
                return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
            })
            ->addColumn('shipment_type', function ($shipment) {
                if ($shipment->shipment_type == 1) {
                    return '<td>Pickup</td>';
                } else {
                    return '<td>Drop Off</td>';
                }
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('total', function ($shipment) {
                return '<td>
                <p>' . $shipment->total . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('reference_no', function ($shipment) {
                return '<td>
                <p>' . $shipment->reference_no . '</p>
                </td>';
            })
            ->addColumn('cod_value', function ($shipment) {
                return '<td>
                <p>' . $shipment->special_cod . '</p>
                </td>';
            })
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a href="/user/view-pending-shipment/'.$shipment->id.'"     class="dropdown-item">View Shipment</a>
                        <a onclick="Delete('.$shipment->id.')" class="dropdown-item" href="#">Delete</a>
                    </div>
                </td>';
            })
            
        ->rawColumns([ 'checkbox','from_address', 'to_address','shipment_type', 'shipment_mode','total','action','reference_no','cod_value'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function scheduleShipment(Request $request)
    {
        
        $data = temp_shipment::whereIn('id', $request->id)->get();
        
        foreach ($data as $row) {
            
        $temp_shipment = temp_shipment::find($row->id);

            $config = [
                'table' => 'shipments',
                'field' => 'order_id',
                'length' => 6,
                'prefix' => '0'
            ];
    
            $order_id = IdGenerator::generate($config);
        
            $from_address = manage_address::find($temp_shipment->from_address);
            $from_station = city::find($from_address->city_id);
    
            $to_address = manage_address::find($temp_shipment->to_address);
            $to_station = city::find($to_address->city_id);
    
            $shipment = new shipment;
            $shipment->order_id = $order_id;
            $shipment->date = date('Y-m-d');
            $shipment->sender_id = $temp_shipment->sender_id;
            $shipment->shipment_type = $temp_shipment->shipment_type;
            $shipment->shipment_date = date('Y-m-d',strtotime($request->shipment_date));
            $shipment->shipment_from_time = $request->shipment_from_time;
            $shipment->shipment_to_time = $request->shipment_to_time;
            $shipment->from_address = $temp_shipment->from_address;
            $shipment->to_address = $temp_shipment->to_address;
            $shipment->from_station_id = $from_station->station_id;
            $shipment->to_station_id = $to_station->station_id;
            $shipment->shipment_mode = $temp_shipment->shipment_mode;
            $shipment->shipment_notes = $temp_shipment->shipment_notes;
            //$shipment->special_service = $temp_shipment->special_service;
            //$shipment->special_service_description = $temp_shipment->special_service_description;
            $shipment->return_package_cost = $temp_shipment->return_package_cost;
            $shipment->special_cod_enable = $temp_shipment->special_cod_enable;
            $shipment->special_cod = $temp_shipment->special_cod;
            $shipment->no_of_packages = $temp_shipment->no_of_packages;
            $shipment->declared_value = $temp_shipment->declared_value;
            $shipment->total_weight = $temp_shipment->total_weight;
            $shipment->shipment_price = $temp_shipment->shipment_price;
            $shipment->postal_charge_percentage = $temp_shipment->postal_charge_percentage;
            $shipment->postal_charge = $temp_shipment->postal_charge;
            $shipment->sub_total = $temp_shipment->sub_total;
            $shipment->vat_percentage = $temp_shipment->vat_percentage;
            $shipment->vat_amount = $temp_shipment->vat_amount;
            $shipment->insurance_percentage = $temp_shipment->insurance_percentage;
            $shipment->insurance_amount = $temp_shipment->insurance_amount;
            $shipment->before_total = $temp_shipment->before_total;
            $shipment->cod_amount = $temp_shipment->cod_amount;
            $shipment->total = $temp_shipment->total;
            $shipment->reference_no = $temp_shipment->reference_no;
            $shipment->identical = $temp_shipment->identical;
            $shipment->save();
                        
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $shipment->id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = Auth::user()->email;
            $system_logs->remark = 'New Shipment Created by Customer '.Auth::user()->first_name . Auth::user()->last_name;
            $system_logs->save();

            $temp_shipment_package = temp_shipment_package::where('temp_id', $temp_shipment->id)->get();
            foreach ($temp_shipment_package as $temp) {
                // do {
                //     $sku_value = mt_rand( 1000000000, 9999999999);
                // } 
                // while ( DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists() );

                $shipment_package = new shipment_package;
                $shipment_package->sku_value = $temp->sku_value;
                $shipment_package->shipment_id = $shipment->id;
                $shipment_package->category = $temp->category;
                //$shipment_package->reference_no = $temp->reference_no;
                $shipment_package->description = $temp->description;
                $shipment_package->weight = $temp->weight;
                $shipment_package->length = $temp->length;
                $shipment_package->width = $temp->width;
                $shipment_package->height = $temp->height;
                $shipment_package->chargeable_weight = $temp->chargeable_weight;

                $shipment_package->save();
            }
            

        $temp_shipment_delete = temp_shipment::find($row->id);
        $temp_shipment_delete->delete();

        temp_shipment_package::where('temp_id', $row->id)->delete();


        }
        return response()->json(["Successfully Update"], 200);
    }




}
