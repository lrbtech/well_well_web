<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\shipment_notes;
use App\Models\shipment_notification;
use App\Models\User;
use App\Models\add_rate;
use App\Models\add_rate_item;
use App\Models\agent;
use App\Models\station;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Mail;
use PDF;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function ShipmentReport(){
        $agent=agent::all();
        return view('admin.shipment_report',compact('agent'));
    }


    public function getShipmentReport($status,$user_type){
        
        $i =DB::table('shipments');
        if ( $user_type != 3 )
        {
            if ( $user_type != 2 ){
                $i->join('users', 'users.id', '=', 'shipments.sender_id');
                $i->where('users.user_type', $user_type);
            }
            else{
                $i->where('shipments.sender_id', 0);
            }
        }
        if ( $status != 9 )
        {
            $i->where('shipments.status', $status);
        }

        $i->orderBy('shipments.id','DESC');
        $shipment = $i->get();

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })

            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                $user = User::find($shipment->sender_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $user->mobile . '</p>
                <p>' . $user->email . '</p>
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
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('total', function ($shipment) {
                return '<td>
                <p>AED ' . $shipment->total . '</p>
                </td>';
            })
            ->addColumn('status', function ($shipment) {
                if($shipment->status == 0){
                    return 'New Request';
                }
                elseif($shipment->status == 1){
                    return 'Approved';
                }
                elseif($shipment->status == 2){
                    return 'Package Collected';
                }
                elseif($shipment->status == 3){
                    return 'Exception';
                    return '<td>
                    <p>Exception</p>
                    <p>' . $shipment->exception_remark . '</p>
                    </td>';
                }
                elseif($shipment->status == 4){
                    return 'Received Station Hub';
                }
                elseif($shipment->status == 5){
                    return 'Assign Agent to Transit Out (Hub)';
                }
                elseif($shipment->status == 6){
                    return 'Other Transit in Received (Hub)';
                }
                elseif($shipment->status == 7){
                    return 'Assign Agent to Delivery';
                }
                elseif($shipment->status == 8){
                    return 'Shipment delivered';
                }
            })
            ->addColumn('action', function ($shipment) {
                if($shipment->status == 8){
                    return '<td>
                    <p><a target="_blank" href="/admin/print-invoice/'.$shipment->id.'" >Print</a></p>
                    </td>';
                }
                else{
                    return '<td>
                    <p><a onclick="PrintLabel('.$shipment->id.')" href="#">Print</a></p>
                    </td>';
                }
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_mode','action','total','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function RevenueReport(){
        $agent=agent::all();
        return view('admin.revenue_report',compact('agent'));
    }


    public function getRevenueReport($fdate,$tdate){

        $fdate = date('Y-m-d', strtotime($fdate));
        $tdate = date('Y-m-d', strtotime($tdate));

        if($fdate != '1970-01-01' && $tdate != '1970-01-01'){
            $shipment = shipment::whereBetween('date', [$fdate, $tdate])->orderBy('id','DESC')->get();
        }else{
            $shipment = shipment::orderBy('id','desc')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            
            ->addColumn('total_weight', function ($shipment) {
                return '<td>
                <p>No of Packages : ' .$shipment->no_of_packages . '</p>
                <p>Total Weight ' .$shipment->total_weight . ' Kg</p>
                </td>';
            })
            ->addColumn('shipment_price', function ($shipment) {
                return '<td>
                <p>' .$shipment->shipment_price . ' AED</p>
                </td>';
            })

            ->addColumn('postal_charge', function ($shipment) {
                return '<td>
                <p>' . $shipment->postal_charge_percentage . ' %</p>
                <p>' . $shipment->postal_charge . ' AED</p>
                </td>';
            })
            ->addColumn('vat', function ($shipment) {
                return '<td>
                <p>' . $shipment->vat_percentage . ' %</p>
                <p>' . $shipment->vat_amount . ' AED</p>
                </td>';
            })
            ->addColumn('insurance', function ($shipment) {
                return '<td>
                <p>' . $shipment->insurance_percentage . ' %</p>
                <p>' . $shipment->insurance_amount . ' AED</p>
                </td>';
            })
            ->addColumn('cod_amount', function ($shipment) {
                return '<td>
                <p>' . $shipment->cod_amount . ' AED</p>
                </td>';
            })
            ->addColumn('total', function ($shipment) {
                return '<td>
                <p>' . $shipment->total . ' AED</p>
                </td>';
            })
            
        ->rawColumns(['order_id','postal_charge', 'shipment_price', 'total_weight','total','vat','insurance','cod_amount'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


}
