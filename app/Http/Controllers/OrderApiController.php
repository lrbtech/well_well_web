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
use App\Models\temp_shipment;
use App\Models\temp_shipment_package;
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

    public function getArea(Request $request){ 
        // $token = $request->header('APP_KEY');
        // $account_id = $request->header('Account_ID');
        $getheaders = apache_request_headers();
        $token = $getheaders['APP_KEY'];
        $account_id = $getheaders['Account_ID'];
        $user = User::where('customer_id',$account_id)->where('status',4)->first();

        //WellWell@2021
        if($token != '$2y$10$/e.dAudOkbZZ2iec4zSNa.eHxLeElTAaeonpe6qtuD14O4VgYR0s2'){
            return response()->json(['message' => 'App Key Not Found'], 401);
        }
        if(empty($user)){
            return response()->json(['message' => 'Account ID Not Found'], 401);
        }
        else{
            $city = city::where('parent_id',0)->where('city',$request->city)->first();
            $data = city::where('parent_id',$city->id)->where('status',0)->orderBy('city','ASC')->get();
            $datas =array();
            foreach($data as $row){
                $data = array(
                    'area' => $row->city,
                );
                $datas[] = $data;
            }
            return response()->json($datas); 
        }
    }

    public function createOrder(Request $request){ 
        // $token = $request->header('APP_KEY');
        // $account_id = $request->header('Account_ID');
        $getheaders = apache_request_headers();
        $token = $getheaders['APP_KEY'];
        $account_id = $getheaders['Account_ID'];
        $user = User::where('customer_id',$account_id)->where('status',4)->first();
        if($token != '$2y$10$/e.dAudOkbZZ2iec4zSNa.eHxLeElTAaeonpe6qtuD14O4VgYR0s2'){
            return response()->json(['message' => 'App Key Not Found'], 401);
        }
        elseif(empty($user)){
            return response()->json(['message' => 'Account ID Not Found'], 401);
        }
        else{

        //return response()->json($request->order['pick_up']['city']);

        $from_address = new manage_address;
        $from_address->user_id = $user->id;
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
        $to_address->user_id = $user->id;
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

        $shipment = new temp_shipment;
        //$shipment->order_id = $order_id;
        $shipment->date = date('Y-m-d');
        $shipment->sender_id = $user->id;
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
        //$shipment->special_cod_enable = $request->order['cod_enable'];
        $shipment->special_cod = $request->order['cod_value'];
        if($request->order['cod_value'] > 0){
            $shipment->special_cod_enable = 1;
        }
        $shipment->no_of_packages = $request->order['no_of_packages'];
        $shipment->declared_value = $request->order['declared_value'];
        $shipment->reference_no = $request->order['reference'];
        $shipment->identical = $request->order['identical'];

        $total_weight=0;
        if($request->order['identical'] == '0'){
            foreach ($request->order['package'] as $row) 
            {
                $dimension = ($row['length'] * $row['width'] * $row['height']) / 5000;
                $chargeable_weight=0;
                if($dimension > $row['weight']){
                    $chargeable_weight = $dimension;
                }
                else{
                    $chargeable_weight = $row['weight'];
                }  
                $total_weight = $total_weight + $chargeable_weight;
            }
        }
        else{
            for ($y=1; $y<=$request->order['no_of_packages']; $y++){
                foreach ($request->order['package'] as $row) 
                {
                    $dimension = ($row['length'] * $row['width'] * $row['height']) / 5000;
                    $chargeable_weight=0;
                    if($dimension > $row['weight']){
                        $chargeable_weight = $dimension;
                    }
                    else{
                        $chargeable_weight = $row['weight'];
                    }  
                    $total_weight = $total_weight + $chargeable_weight;
                }
            }
        }
        
        $shipment->total_weight = $total_weight;
        $cod_enable;
        if($request->order['cod_enable'] == '1'){
            $cod_enable=1;
        }
        else{
            $cod_enable=0;
        }
        
        $price = $this->getShipmentPrice($user->id,$total_weight,$to_address->id,$request->order['shipment_mode'],$request->order['declared_value'],$cod_enable);


        $shipment->shipment_price = $price->original['shipment_price'];
        $shipment->postal_charge_percentage = $price->original['postal_charge_percentage'];
        $shipment->postal_charge = $price->original['postal_charge'];
        $shipment->sub_total = $price->original['sub_total'];
        $shipment->vat_percentage = $price->original['vat_percentage'];
        $shipment->vat_amount = $price->original['vat_amount'];
        $shipment->insurance_percentage = $price->original['insurance_percentage'];
        $shipment->insurance_amount = $price->original['insurance_amount'];
        $shipment->cod_amount = $price->original['cod_amount'];
        $shipment->total = $price->original['total'];
        
        $shipment->save();


        if($request->order['identical'] == '0'){
            foreach ($request->order['package'] as $row) 
            {
                $sku_value =  $this->generateSkuValue();

                $shipment_package = new temp_shipment_package;
                $shipment_package->sku_value = $sku_value;
                $shipment_package->temp_id = $shipment->id;
                $shipment_package->category = $row['category'];
                $shipment_package->description = $row['description'];
                $shipment_package->weight = $row['weight'];
                $shipment_package->length = $row['length'];
                $shipment_package->width = $row['width'];
                $shipment_package->height = $row['height'];
                $dimension = ($row['length'] * $row['width'] * $row['height']) / 5000;
                $chargeable_weight=0;
                if($dimension > $row['weight']){
                    $chargeable_weight = $dimension;
                }
                else{
                    $chargeable_weight = $row['weight'];
                }  
                $shipment_package->chargeable_weight = $chargeable_weight;
                $shipment_package->save();
            }
        }
        else{
            for ($y=1; $y<=$request->order['no_of_packages']; $y++){
                foreach ($request->order['package'] as $row) 
                {
                    $sku_value =  $this->generateSkuValue();

                    $shipment_package = new temp_shipment_package;
                    $shipment_package->sku_value = $sku_value;
                    $shipment_package->temp_id = $shipment->id;
                    $shipment_package->category = $row['category'];
                    $shipment_package->description = $row['description'];
                    $shipment_package->weight = $row['weight'];
                    $shipment_package->length = $row['length'];
                    $shipment_package->width = $row['width'];
                    $shipment_package->height = $row['height'];
                    $dimension = ($row['length'] * $row['width'] * $row['height']) / 5000;
                    $chargeable_weight=0;
                    if($dimension > $row['weight']){
                        $chargeable_weight = $dimension;
                    }
                    else{
                        $chargeable_weight = $row['weight'];
                    }  
                    $shipment_package->chargeable_weight = $chargeable_weight;
                    $shipment_package->save();
                }
            }
        }
        $temp_shipment_package = temp_shipment_package::where('temp_id',$shipment->id)->get();
        $sku_value1;
        foreach($temp_shipment_package as $row){
            $sku_value1[]=$row->sku_value;
        }
        $sku_value = collect($sku_value1)->implode(',');

        return response()->json(['id' => $shipment->id , 'sku_value' => $sku_value , 'message' => 'Save Successfully','status'=>200], 200);
        }
    }

    private function generateSkuValue(){
        $sku_value = mt_rand( 1000000000, 9999999999);
        if(DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists()){
            $this->generateSkuValue();
        }
        else{
            if(DB::table( 'temp_shipment_packages' )->where( 'sku_value', $sku_value )->exists()){
                $this->generateSkuValue();
            }
            else{
                return $sku_value;
            }
        }
    }

    public function getShipmentPrice($user_id,$weight,$to_address,$shipment_mode,$declared_value,$cod_enable){
        $rate = add_rate::where('user_id',$user_id)->first();
        $address = manage_address::find($to_address);
        $area = city::find($address->area_id);
        $data =array();

        $price=0;
        if($area->remote_area == '0'){
            if('0' <= $weight && '5' >= $weight && $shipment_mode == '1'){
                $price = $rate->service_area_0_to_5_kg_price;
            }
            elseif('5.1' <= $weight && '10' >= $weight && $shipment_mode == '1'){
                $price = $rate->service_area_5_to_10_kg_price;
            }
            elseif('10.1' <= $weight && '15' >= $weight && $shipment_mode == '1'){
                $price = $rate->service_area_10_to_15_kg_price;
            }
            elseif('15.1' <= $weight && '20' >= $weight && $shipment_mode == '1'){
                $price = $rate->service_area_15_to_20_kg_price;
            }
            elseif('20.1' <= $weight && '99999' >= $weight && $shipment_mode == '1'){
                $price = (($weight - 20) * $rate->service_area_20_to_1000_kg_price) + $rate->service_area_15_to_20_kg_price; 
            }
            elseif('0' <= $weight && '5' >= $weight && $shipment_mode == '2'){
                $price = $rate->same_day_delivery_0_to_5_kg_price;
            }
            elseif('5.1' <= $weight && '10' >= $weight && $shipment_mode == '2'){
                $price = $rate->same_day_delivery_5_to_10_kg_price;
            }
            elseif('10.1' <= $weight && '15' >= $weight && $shipment_mode == '2'){
                $price = $rate->same_day_delivery_10_to_15_kg_price;
            }
            elseif('15.1' <= $weight && '10' >= $weight && $shipment_mode == '2'){
                $price = $rate->same_day_delivery_15_to_20_kg_price;
            }
            elseif('20.1' <= $weight && '999999' >= $weight && $shipment_mode == '2'){
                $price = (($weight - 20) * $rate->same_day_delivery_20_to_1000_kg_price) + $rate->same_day_delivery_15_to_20_kg_price;
            }
        }
        else{
            $price1=0;
            if($shipment_mode == '1'){
                $price1 = $rate->service_area_0_to_5_kg_price;
            }
            elseif($shipment_mode == '2'){
                $price1 = $rate->same_day_delivery_0_to_5_kg_price;
            }
            if('0' <= $weight && '5' >= $weight){
                $price = $rate->before_5_kg_price + $price1;
            }
            else{
                $price = (($weight - 5) * $rate->above_5_kg_price) + $rate->before_5_kg_price + $price1;
            }
        }

        $insurance_amount = 0;
        $cod_amount = 0;
        $vat_amount = 0;
        $postal_charge = 0;

        $settings = settings::find('1');
        if($rate->insurance_enable == 1){
            $insurance_amount = ($settings->insurance_percentage/100) * $declared_value;
        }
        
        if($cod_enable == 1){
            $cod_amount = $settings->cod_amount;
        }

        $sub_total = $price + $insurance_amount + $cod_amount;

        if($rate->vat_enable == 1){
        $vat_amount = ($settings->vat_percentage/100) * $sub_total;
        }
    
        if($rate->postal_charge_enable == 1){
            if($weight >= 30){
                $postal_charge = 0;
            }
            else{
                $postal_charge = ($settings->postal_charge_percentage/100) * $price;
                if($postal_charge < 2){
                    $postal_charge = 2;
                }
            }
        }

        $total = $sub_total + $vat_amount + $postal_charge;

        $data = array(
            'shipment_price' => round($price,2),
            'postal_charge_percentage' => round($settings->postal_charge_percentage,2),
            'postal_charge' => round($postal_charge,2),
            'cod_amount' => round($cod_amount,2),
            'sub_total' => round($sub_total,2),
            'vat_percentage' => round($settings->vat_percentage,2),
            'vat_amount' => round($vat_amount,2),
            'insurance_percentage' => round($settings->insurance_percentage,2),
            'insurance_amount' => round($insurance_amount,2),
            'total' => round($total,2),
        );

        return response()->json($data);
    }



    public function pendingShipment(Request $request){ 
        // $token = $request->header('APP_KEY');
        // $account_id = $request->header('Account_ID');
        $getheaders = apache_request_headers();
        $token = $getheaders['APP_KEY'];
        $account_id = $getheaders['Account_ID'];
        $user = User::where('customer_id',$account_id)->where('status',4)->first();
        //WellWell@2021
        if($token != '$2y$10$/e.dAudOkbZZ2iec4zSNa.eHxLeElTAaeonpe6qtuD14O4VgYR0s2'){
            return response()->json(['message' => 'App Key Not Found'], 401);
        }
        elseif(empty($user)){
            return response()->json(['message' => 'Account ID Not Found'], 401);
        }
        else{
            $shipment = temp_shipment::where('sender_id',$user->id)->get();
            $data =array();
            $datas =array();
            foreach ($shipment as $key => $value) {
                $from_address = manage_address::find($value->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $to_address = manage_address::find($value->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $data = array(
                    'id' => $value->id,
                    'to_address' => $to_address->address1.' '.$to_address->address2 .' '.$to_address->address3,
                    'to_city' => $to_city->city,
                    'to_area' => $to_area->city,
                    'to_name' => $to_address->contact_name,
                    'to_mobile' => $to_address->contact_mobile,
                    'reference' => $value->reference_no,
                    'cod_value' => $value->special_cod,
                );
                
                $datas[] = $data;
            }   
            return response()->json($datas);
        }
    }


    public function deletePendingShipment(Request $request)
    {
        // $token = $request->header('APP_KEY');
        // $account_id = $request->header('Account_ID');
        $getheaders = apache_request_headers();
        $token = $getheaders['APP_KEY'];
        $account_id = $getheaders['Account_ID'];
        $user = User::where('customer_id',$account_id)->where('status',4)->first();
        //WellWell@2021
        if($token != '$2y$10$/e.dAudOkbZZ2iec4zSNa.eHxLeElTAaeonpe6qtuD14O4VgYR0s2'){
            return response()->json(['message' => 'App Key Not Found'], 401);
        }
        elseif(empty($user)){
            return response()->json(['message' => 'Account ID Not Found'], 401);
        }
        else{
            $temp_shipment_delete = temp_shipment::find($request->order_id);
            $temp_shipment_delete->delete();
            temp_shipment_package::where('temp_id', $request->order_id)->delete();
            return response()->json(['message' => 'Delete Successfully'],200);
        }
    }

    public function shipmentCancel(Request $request)
    {
        // $token = $request->header('APP_KEY');
        // $account_id = $request->header('Account_ID');
        $getheaders = apache_request_headers();
        $token = $getheaders['APP_KEY'];
        $account_id = $getheaders['Account_ID'];
        $user = User::where('customer_id',$account_id)->where('status',4)->first();
        //WellWell@2021
        if($token != '$2y$10$/e.dAudOkbZZ2iec4zSNa.eHxLeElTAaeonpe6qtuD14O4VgYR0s2'){
            return response()->json(['message' => 'App Key Not Found'], 401);
        }
        elseif(empty($user)){
            return response()->json(['message' => 'Account ID Not Found'], 401);
        }
        else{
            $shipment_package = shipment_package::where('sku_value',$request->sku_value)->first();

            $shipment = shipment::find($shipment_package->shipment_id);
            $shipment->cancel_remark = $request->cancel_remark;
            $shipment->cancel_request_date = date('Y-m-d');
            $shipment->cancel_request_time = date('H:i:s');
            if($shipment->status >= 2){
                $shipment->cancel_pay = 1;
            }
            $shipment->status = 10;
            $shipment->save();

            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $shipment->id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $user->email;
            $system_logs->remark = 'Cancel Shipment Created by Customer';
            $system_logs->save();

            return response()->json(['message' => 'Shipment Cancel Successfully'],200);
        }
    }

    public function shipmentHold(Request $request)
    {
        // $token = $request->header('APP_KEY');
        // $account_id = $request->header('Account_ID');
        $getheaders = apache_request_headers();
        $token = $getheaders['APP_KEY'];
        $account_id = $getheaders['Account_ID'];
        $user = User::where('customer_id',$account_id)->where('status',4)->first();
        //WellWell@2021
        if($token != '$2y$10$/e.dAudOkbZZ2iec4zSNa.eHxLeElTAaeonpe6qtuD14O4VgYR0s2'){
            return response()->json(['message' => 'App Key Not Found'], 401);
        }
        elseif(empty($user)){
            return response()->json(['message' => 'Account ID Not Found'], 401);
        }
        else{
            $shipment_package = shipment_package::where('sku_value',$request->sku_value)->first();

            $shipment = shipment::find($shipment_package->shipment_id);
            $shipment->hold_status = 1;
            $shipment->save();
            
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $shipment->id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $user->email;
            $system_logs->remark = 'Active Hold Shipment by Customer';
            $system_logs->save();

            return response()->json(['message' => 'Shipment Hold Successfully'],200);
        }
    }

    public function shipmentUnhold(Request $request)
    {
        // $token = $request->header('APP_KEY');
        // $account_id = $request->header('Account_ID');
        $getheaders = apache_request_headers();
        $token = $getheaders['APP_KEY'];
        $account_id = $getheaders['Account_ID'];
        $user = User::where('customer_id',$account_id)->where('status',4)->first();
        //WellWell@2021
        if($token != '$2y$10$/e.dAudOkbZZ2iec4zSNa.eHxLeElTAaeonpe6qtuD14O4VgYR0s2'){
            return response()->json(['message' => 'App Key Not Found'], 401);
        }
        elseif(empty($user)){
            return response()->json(['message' => 'Account ID Not Found'], 401);
        }
        else{
            $shipment_package = shipment_package::where('sku_value',$request->sku_value)->first();

            $shipment = shipment::find($shipment_package->shipment_id);
            $shipment->hold_status = 0;
            $shipment->save();
            
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $shipment->id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $user->email;
            $system_logs->remark = 'Cancel Hold Shipment by Customer';
            $system_logs->save();

            return response()->json(['message' => 'Shipment UnHold Successfully'],200);
        }
    }



}
