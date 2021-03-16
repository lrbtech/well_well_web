<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agent;
use App\Models\city;
use App\Models\User;
use App\Models\shipment;
use App\Models\shipment_package;
use App\Models\station;
use App\Models\manage_address;
use App\Models\package_category;
use App\Models\exception_category;
use App\Models\country;
use App\Models\add_rate;
use App\Models\add_rate_item;
use App\Models\settings;
use App\Models\common_price;
use App\Models\revenue_exception_log;
use App\Models\system_logs;
use App\Models\guest_user;
use App\Models\ship_now_mobile_verify;
use Hash;
use Mail;
use PDF;
use DB;

class OrderApiController extends Controller
{
    // public function getArea(Request $request){ 
    //     return response()->json(['message' => 'Unauthorized Access','status'=>419], 419);
    // }

    public function getArea(Request $request){ 
        $city = city::where('parent_id',0)->where('city',$request->city)->first();
        $data = city::where('parent_id',$city->id)->where('status',0)->orderBy('city','ASC')->get();
        $datas =array();
        foreach($data as $row){
            $datas[]=$row->city;
        }
        return response()->json($data); 
    }

    public function createOrder(Request $request){ 
        // $config = [
        //     'table' => 'shipments',
        //     'field' => 'order_id',
        //     'length' => 6,
        //     'prefix' => '0'
        // ];

        // $order_id = IdGenerator::generate($config);

        $from_address = new manage_address;
        $from_address->user_id = 0;
        $from_address->from_to = 1;
        $from_city = city::where('parent_id',0)->where('city',$request->order['pick_up']['city'])->first();
        $from_address->city_id = $from_city->id;
        $from_area = city::where('parent_id',$from_city->id)->where('city',$request->order['pick_up']['area'])->first();
        $from_address->area_id = $from_area->id;
        $from_address->country_id = 1;
        $from_address->contact_name = $request->order['pick_up']['name'];
        $from_address->contact_mobile = $request->order['pick_up']['mobile'];
        $from_address->contact_landline = $request->order['pick_up']['land_line'];
        $from_address_type=0;
        if($request->order['pick_up']['address_type'] == 'Home'){
            $from_address_type=1;
        }
        elseif($request->order['pick_up']['address_type'] == 'Office'){
            $from_address_type=2;
        }
        elseif($request->order['pick_up']['address_type'] == 'Other'){
            $from_address_type=3;
        }
        $from_address->address_type = $from_address_type;
        $from_address->latitude = $request->order['pick_up']['latitude'];
        $from_address->longitude = $request->order['pick_up']['longitude'];
        $from_address->address1 = $request->order['pick_up']['address'];
        $from_address->save();

        $to_address = new manage_address;
        $to_address->user_id = 0;
        $to_address->from_to = 2;
        $to_city = city::where('parent_id',0)->where('city',$request->order['delivery']['city'])->first();
        $to_address->city_id = $to_city->id;
        $to_area = city::where('parent_id',$to_city->id)->where('city',$request->order['delivery']['area'])->first();
        $to_address->area_id = $to_area->id;
        $to_address->country_id = 1;
        $to_address->contact_name = $request->order['delivery']['name'];
        $to_address->contact_mobile = $request->order['delivery']['mobile'];
        $to_address->contact_landline = $request->order['delivery']['land_line'];
        $to_address_type=0;
        if($request->order['delivery']['address_type'] == 'Home'){
            $to_address_type=1;
        }
        elseif($request->order['delivery']['address_type'] == 'Office'){
            $to_address_type=2;
        }
        elseif($request->order['delivery']['address_type'] == 'Other'){
            $to_address_type=3;
        }
        $to_address->address_type = $to_address_type;
        $to_address->latitude = $request->order['delivery']['latitude'];
        $to_address->longitude = $request->order['delivery']['longitude'];
        $to_address->address1 = $request->order['delivery']['address'];
        $to_address->save();
        
        $from_station = city::find($from_city->id);
        $to_station = city::find($to_city->id);

        $shipment = new shipment;
        //$shipment->order_id = $order_id;
        $shipment->date = date('Y-m-d');
        //$shipment->sender_id = $request->user_id;
        $shipment->shipment_type = 1;
        //$shipment->shipment_date = date('Y-m-d',strtotime($request->shipment_date));
        //$shipment->shipment_from_time = $request->shipment_from_time;
        //$shipment->shipment_to_time = $request->shipment_to_time;
        $shipment->from_address = $from_address->id;
        $shipment->to_address = $to_address->id;
        $shipment->from_station_id = $from_station->station_id;
        $shipment->to_station_id = $to_station->station_id;
        $shipment->shipment_mode = $request->order['shipment_mode'];
        $shipment->return_package_cost = 2;
        $shipment->special_cod_enable = $request->order['cod_enable'];
        $shipment->special_cod = $request->order['cod_value'];
        $shipment->no_of_packages = $request->order['no_of_packages'];
        $shipment->declared_value = $request->order['declared_value'];
        $shipment->reference_no = $request->order['reference'];
        $shipment->identical = $request->order['identical'];
        
        $shipment->total_weight = $request->total_weight;
        $shipment->shipment_price = $request->shipment_price;
        $shipment->postal_charge_percentage = $request->postal_charge_percentage;
        $shipment->postal_charge = $request->postal_charge;
        $shipment->sub_total = $request->sub_total;
        $shipment->vat_percentage = $request->vat_percentage;
        $shipment->vat_amount = $request->vat_amount;
        $shipment->insurance_percentage = $request->insurance_percentage;
        $shipment->insurance_amount = $request->insurance_amount;
        $shipment->cod_amount = $request->cod_amount;
        $shipment->total = $request->total;
        
        $shipment->save();

        $system_logs = new system_logs;
        $system_logs->_id = $shipment->id;
        $system_logs->category = 'shipment';
        $system_logs->to_id = Auth::guard('admin')->user()->email;
        $system_logs->remark = 'New Shipment Created to '.Auth::guard('admin')->user()->name;
        $system_logs->save();

        $arrayshipment = array();
        $arrayshipment[] = $shipment->id;

        if($request->same_data == '0'){
            for ($x=0; $x<count($_POST['weight']); $x++) 
            {
                do {
                    $sku_value = mt_rand( 1000000000, 9999999999 );
                } 
                while ( DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists() );

                $shipment_package = new shipment_package;
                $shipment_package->sku_value = $sku_value;
                $shipment_package->shipment_id = $shipment->id;
                $shipment_package->category = $_POST['category'][$x];
               // $shipment_package->reference_no = $_POST['reference_no'][$x];
                $shipment_package->description = $_POST['description'][$x];
                $shipment_package->weight = $_POST['weight'][$x];
                $shipment_package->length = $_POST['length'][$x];
                $shipment_package->width = $_POST['width'][$x];
                $shipment_package->height = $_POST['height'][$x];
                $shipment_package->chargeable_weight = $_POST['chargeable_weight'][$x];

                if($_POST['weight'][$x]!=""){
                    $shipment_package->save();
                }
            }
        }
        else{
            for ($y=1; $y<=$request->no_of_packages; $y++){
                for ($x=0; $x<count($_POST['weight']); $x++) 
                {
                    do {
                        $sku_value = mt_rand( 1000000000, 9999999999 );
                    } 
                    while ( DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists() );
                    $shipment_package = new shipment_package;
                    $shipment_package->sku_value = $sku_value;
                    $shipment_package->shipment_id = $shipment->id;
                    $shipment_package->category = $_POST['category'][$x];
                    //$shipment_package->reference_no = $_POST['reference_no'][$x];
                    $shipment_package->description = $_POST['description'][$x];
                    $shipment_package->weight = $_POST['weight'][$x];
                    $shipment_package->length = $_POST['length'][$x];
                    $shipment_package->width = $_POST['width'][$x];
                    $shipment_package->height = $_POST['height'][$x];
                    $shipment_package->chargeable_weight = $_POST['chargeable_weight'][$x];

                    if($_POST['weight'][$x]!=""){
                        $shipment_package->save();
                    }
                }
            }
        }

        //return response()->json(['message' => 'Unauthorized Access','status'=>419], 419);
    }
}
