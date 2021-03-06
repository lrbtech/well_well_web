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
use Hash;
use Mail;
use PDF;
use DB;


class ApiController extends Controller
{
    public function __construct()
    {
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

    private function send_sms($phone,$msg)
    {
        $requestParams = array(
          'api_key' => 'C2003249604f3c09173d94.20000197',
          'type' => 'text',
          'contacts' => '+971'.$phone,
          'senderid' => 'WellWellExp',
          'msg' => $msg
        );
        
        //merge API url and parameters
        $apiUrl = 'https://www.elitbuzz-me.com/sms/smsapi?';
        foreach($requestParams as $key => $val){
            $apiUrl .= $key.'='.urlencode($val).'&';
        }
        $apiUrl = rtrim($apiUrl, "&");
      
        //API call
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      
        curl_exec($ch);
        curl_close($ch);
    }

    public function sendNotificationAgent($msg,$agent_id){
        $agent = agent::find($agent_id);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$agent->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$msg\",\r\n  \"title\" : \"\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$msg\",\r\n  \"title\" : \"\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: key=AAAA8MuJ8ds:APA91bG2jOF4RQMoEu_sThruub8PeCu6SYjOOBA1Ba1TNd561DK9OPfqnEZS1GlD5BFfDvDsZBwkbCltNbfNU0Z3IO1emZniEYGuGPSmeNkd8XHz-3xqQ4gB_wbLaDKghMvUJqFYoy5T",
            "Content-Type: application/json"
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
    }

    public function sendNotificationUser($msg,$user_id){
        $user = User::find($user_id);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$user->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$msg\",\r\n  \"title\" : \"\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$msg\",\r\n  \"title\" : \"\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: key=AAAAlESNo9M:APA91bHKOmvgPs5gn_Gtbtgr0k5PogtXfMIgQmF7bA7X9Uy3VsNnVbSX-AOiETPeEplQiDaoDBFACzYxw7y6w77bjvg6CscQ5riG_U9burGBv1b2fO_XI1Mtyyozl57Rvfz0KM4Z16K6",
            "Content-Type: application/json"
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
    }


    public function agentLogin(Request $request){
        $exist = agent::where('email',$request->email)->where('status',0)->get();
        if(count($exist)>0){
            //if($exist[0]->status == 1){
                if(Hash::check($request->password,$exist[0]->password)){
                    $agent = agent::find($exist[0]->id);
                    $agent->firebase_key = $request->firebase_key;
                    $agent->save();

                return response()->json(['message' => 'Login Successfully',
                'name'=>$exist[0]->name,
                'pickup'=>$exist[0]->pickup,
                'delivery'=>$exist[0]->delivery,
                'revenue_exception'=>$exist[0]->revenue_exception,
                'cash_report'=>$exist[0]->cash_report,
                'hub'=>$exist[0]->hub,
                'van_scan'=>$exist[0]->van_scan,
                'agent_id'=>$exist[0]->id,'status'=>200], 200);
                }else{
                    return response()->json(['message' => 'Records Does not Match','status'=>403], 403);
                }
            // }else{
            //     return response()->json(['message' => 'Verify Your Account','status'=>401,'agent_id'=>$exist[0]->id], 401);
            // }
        }else{
            return response()->json(['message' => 'This Email Address Not Registered','status'=>404], 404);
        }
    }

    public function getPickup($agent_id){
        $shipment = shipment::where('pickup_agent_id',$agent_id)->where('status',1)->get();
        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $shipment_package = shipment_package::where('shipment_id',$value->id)->get();
            $data = array(
                'id' => $value->id,
                'order_id' => $shipment_package[0]->sku_value,
                'shipment_mode' => $value->shipment_mode,
                'shipment_date' => $value->shipment_date,
                'shipment_from_time' => $value->shipment_from_time,
                //'shipment_to_time' => $value->shipment_to_time,
                'address1' => '',
                'address2' => '',
                'address3' => '',
                'city' => '',
                'area' => '',
                'name' => '',
                'mobile' => '',
                'user_type' => '',
                // 'special_cop' => '',
            );
            // if($shipment->special_cop != 'null'){
            //     $data['special_cop'] = $shipment->special_cop;
            // }
            $address = manage_address::find($value->from_address);
            $city = city::find($address->city_id);
            $area = city::find($address->area_id);

            $user = User::find($value->sender_id);
            if($value->sender_id != 0){
                $data['user_type']=1;
            }
            else{
                $data['user_type']=0;
            }
            if(!empty($user)){
                if($user->user_type == '0'){
                    $data['name'] = $user->first_name . $user->last_name;
                }
                else{
                    $data['name'] = $user->business_name;
                }
                $data['mobile'] = $user->mobile;
            }
            else{
                $data['name'] = $address->contact_name;
            }
            
            if(!empty($address->address1)){
                $data['address1'] = $address->address1;
            }
            if(!empty($address->address2)){
                $data['address2'] = $address->address2;
            }
            if(!empty($address->address3)){
                $data['address3'] = $address->address3;
            }
            if(!empty($city)){
                $data['city'] = $city->city;
            }
            if(!empty($area)){
                $data['area'] = $area->city;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getDelivery($agent_id){
        $shipment = shipment::where('delivery_agent_id',$agent_id)->where('status',7)->get();
        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $shipment_package = shipment_package::where('shipment_id',$value->id)->get();
            $data = array(
                'id' => $value->id,
                'order_id' => $shipment_package[0]->sku_value,
                'shipment_mode' => $value->shipment_mode,
                'shipment_date' => $value->shipment_date,
                'shipment_from_time' => $value->shipment_from_time,
                //'shipment_to_time' => $value->shipment_to_time,
                'address1' => '',
                'address2' => '',
                'address3' => '',
                'city' => '',
                'area' => '',
                'name' => '',
                'mobile' => '',
            );
            $address = manage_address::find($value->to_address);
            $city = city::find($address->city_id);
            $area = city::find($address->area_id);

            $user = User::find($value->sender_id);
            if(!empty($user)){
                if($user->user_type == '0'){
                    $data['name'] = $user->first_name . $user->last_name;
                }
                else{
                    $data['name'] = $user->business_name;
                }
                $data['mobile'] = $user->mobile;
            }
            else{
                $data['name'] = $address->contact_name;
            }
            if(!empty($address->address1)){
                $data['address1'] = $address->address1;
            }
            if(!empty($address->address2)){
                $data['address2'] = $address->address2;
            }
            if(!empty($address->address3)){
                $data['address3'] = $address->address3;
            }
            if(!empty($city)){
                $data['city'] = $city->city;
            }
            if(!empty($area)){
                $data['area'] = $area->city;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getStation($agent_id){
        $shipment = shipment::where('transit_in_id',$agent_id)->where('status',5)->get();
        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_station = station::find($value->from_station_id);
            $to_station = station::find($value->to_station_id);
            $data = array(
                'id' => $value->id,
                'order_id' => $value->order_id,
                'from_station' => $from_station->station,
                'to_station' => $to_station->station,
                //'date_time' => $value->station_assign_date,
            );
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getShipmentPacakgae($id){
        $shipment_package = shipment_package::where('shipment_id',$id)->get();

        $data =array();
        $datas =array();
        foreach ($shipment_package as $key => $value) {
            $category = package_category::find($value->category);
            $data = array(
                'id' => $value->id,
                'category' => $category->category,
                'description' => $value->description,
                'weight' => $value->weight,
                'length' => $value->length,
                'width' => $value->width,
                'height' => $value->height,
                'price' => $value->chargeable_weight,
                'barcode_package' => $value->sku_value,
                'exception' => 0,
                'exception_category' => '',
                'exception_remark' => '',
            );
            if($value->exception != null){
                $data['exception'] = (int)$value->exception;
            }
            if($value->exception_category != null){
                $data['exception_category'] = $value->exception_category;
            }
            if($value->exception_remark != null){
                $data['exception_remark'] = $value->exception_remark;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getPickupDetails($id){
        $shipment = shipment::find($id);
        $data =array();
        $shipment_package = shipment_package::where('shipment_id',$id)->get();

        $data = array(
            'id' => $shipment->id,
            'order_id' => $shipment_package[0]->sku_value,
            'shipment_mode' => $shipment->shipment_mode,
            'shipment_date' => $shipment->shipment_date,
            'shipment_from_time' => $shipment->shipment_from_time,
            //'shipment_to_time' => $shipment->shipment_to_time,
            'address1' => '',
            'address2' => '',
            'address3' => '',
            'latitude' => '',
            'longitude' => '',
            'city' => '',
            'area' => '',
            'name' => '',
            'mobile' => '',
            'printpdf' => '',
            'shipment_price' => $shipment->shipment_price,
            'no_of_packages' => $shipment->no_of_packages,
            'declared_value' => $shipment->declared_value,
            'total' => $shipment->total,
            'sub_total' => $shipment->sub_total,
            'postal_charge_percentage' => '',
            'postal_charge' => '',
            'vat_percentage' => '',
            'vat_amount' => '',
            'insurance_percentage' => '',
            'insurance_amount' => '',
            'cod_amount' => '',
            'user_type'=>'',
            //'special_cop' => '',
        );
        
        if($shipment->sender_id != 0){
            $data['user_type']=1;
        }
        else{
            $data['user_type']=0;
        }
        if($shipment->pdf_print != 'null'){
            $data['printpdf'] = $shipment->pdf_print;
        }
        if($shipment->postal_charge_percentage != 'null'){
            $data['postal_charge_percentage'] = $shipment->postal_charge_percentage;
            $data['postal_charge'] = $shipment->postal_charge;
        }
        if($shipment->vat_percentage != 'null'){
            $data['vat_percentage'] = $shipment->vat_percentage;
            $data['vat_amount'] = $shipment->vat_amount;
        }
        if($shipment->insurance_percentage != 'null'){
            $data['insurance_percentage'] = $shipment->insurance_percentage;
            $data['insurance_amount'] = $shipment->insurance_amount;
        }
        if($shipment->cod_amount != 'null'){
            $data['cod_amount'] = $shipment->cod_amount;
        }
        // if($shipment->special_cop != 'null'){
        //     $data['special_cop'] = $shipment->special_cop;
        // }
        $address = manage_address::find($shipment->from_address);
        $city = city::find($address->city_id);
        $area = city::find($address->area_id);

        $user = User::find($shipment->sender_id);
        if(!empty($user)){
            if($user->user_type == '0'){
                $data['name'] = $user->first_name . $user->last_name;
            }
            else{
                $data['name'] = $user->business_name;
            }
            $data['mobile'] = $user->mobile;
        }
        else{
            $data['name'] = $address->contact_name;
        }
        if(!empty($address->address1)){
            $data['address1'] = $address->address1;
        }
        if(!empty($address->address2)){
            $data['address2'] = $address->address2;
        }
        if(!empty($address->address3)){
            $data['address3'] = $address->address3;
        }
        if(!empty($address->latitude)){
            $data['latitude'] = $address->latitude;
        }
        if(!empty($address->longitude)){
            $data['longitude'] = $address->longitude;
        }
        if(!empty($city)){
            $data['city'] = $city->city;
        }
        if(!empty($area)){
            $data['area'] = $area->city;
        }
        return response()->json($data); 
    }


    public function getDeliveryDetails($id){
        $shipment = shipment::find($id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();

        $data = array(
            'id' => $shipment->id,
            'order_id' => $shipment_package[0]->sku_value,
            'shipment_mode' => $shipment->shipment_mode,
            'shipment_date' => $shipment->shipment_date,
            'shipment_from_time' => $shipment->shipment_from_time,
            //'shipment_to_time' => $shipment->shipment_to_time,
            'address1' => '',
            'address2' => '',
            'address3' => '',
            'latitude' => '',
            'longitude' => '',
            'city' => '',
            'area' => '',
            'name' => '',
            'mobile' => '',
            'special_cod' => '',
            'shipment_price' => $shipment->shipment_price,
            'no_of_packages' => $shipment->no_of_packages,
            'declared_value' => $shipment->declared_value,
            'total' => $shipment->total,
            'sub_total' => $shipment->sub_total,
            'postal_charge_percentage' => '',
            'postal_charge' => '',
            'vat_percentage' => '',
            'vat_amount' => '',
            'insurance_percentage' => '',
            'insurance_amount' => '',
            'cod_amount' => '',
            'from_station' => '',
            'to_station' => '',
        );

        $from_station = station::find($shipment->from_station_id);
        $to_station = station::find($shipment->to_station_id);
            
        if(!empty($from_station)){
            $data['from_station'] = $from_station->station;
        }
        if(!empty($to_station)){
            $data['to_station'] = $to_station->station;
        }
        if($shipment->special_cod_enable == '1' && $shipment->special_cod != 'null' && $shipment->special_cod != ''){
            $data['special_cod'] = $shipment->special_cod;
        }
        if($shipment->postal_charge_percentage != 'null'){
            $data['postal_charge_percentage'] = $shipment->postal_charge_percentage;
            $data['postal_charge'] = $shipment->postal_charge;
        }
        if($shipment->vat_percentage != 'null'){
            $data['vat_percentage'] = $shipment->vat_percentage;
            $data['vat_amount'] = $shipment->vat_amount;
        }
        if($shipment->insurance_percentage != 'null'){
            $data['insurance_percentage'] = $shipment->insurance_percentage;
            $data['insurance_amount'] = $shipment->insurance_amount;
        }
        if($shipment->cod_amount != 'null'){
            $data['cod_amount'] = $shipment->cod_amount;
        }
        $address = manage_address::find($shipment->to_address);
        $city = city::find($address->city_id);
        $area = city::find($address->area_id);

        $user = User::find($shipment->sender_id);
        if(!empty($user)){
            if($user->user_type == '0'){
                $data['name'] = $user->first_name . $user->last_name;
            }
            else{
                $data['name'] = $user->business_name;
            }
            $data['mobile'] = $user->mobile;
        }
        else{
            $data['name'] = $address->contact_name;
        }
        if(!empty($address->longitude)){
            $data['longitude'] = $address->longitude;
        }
        if(!empty($city)){
            $data['city'] = $city->city;
        }
        if(!empty($area)){
            $data['area'] = $area->city;
        }
        return response()->json($data); 
    }

    public function updatePackageDetails(Request $request){
        try{
            $shipment_package = shipment_package::find($request->id);

            $revenue_exception_log = new revenue_exception_log;
            $revenue_exception_log->package_id = $shipment_package->id;
            $revenue_exception_log->shipment_id = $shipment_package->shipment_id;
            $revenue_exception_log->old_weight = $shipment_package->weight;
            $revenue_exception_log->old_length = $shipment_package->length;
            $revenue_exception_log->old_width = $shipment_package->width;
            $revenue_exception_log->old_height = $shipment_package->height;
            $revenue_exception_log->old_chargeable_weight = $shipment_package->chargeable_weight;

            $shipment_package->weight = $request->weight;
            $shipment_package->length = $request->length;
            $shipment_package->width = $request->width;
            $shipment_package->height = $request->height;
            $chargeable_weight = 0;
            $dimension = ($request->length * $request->width * $request->height) / 5000;
            if($dimension > $request->weight)
            {
                $chargeable_weight = $dimension;
            }
            else{
                $chargeable_weight = $request->weight;
            }
            $shipment_package->chargeable_weight = $chargeable_weight;

            
            $revenue_exception_log->weight = $request->weight;
            $revenue_exception_log->length = $request->length;
            $revenue_exception_log->width = $request->width;
            $revenue_exception_log->height = $request->height;
            $revenue_exception_log->chargeable_weight = $chargeable_weight;
            $revenue_exception_log->save();

            $shipment_package->save();

            $total_weight = shipment_package::where('shipment_id',$shipment_package->shipment_id)->sum('chargeable_weight');

            $shipment = shipment::find($shipment_package->shipment_id);
            $shipment->total_weight = $total_weight;

        $price=0;
        
    if($shipment->sender_id != '0'){
        $rate = add_rate::where('user_id',$shipment->sender_id)->first();
        $address = manage_address::find($shipment->to_address);
        $area = city::find($address->area_id);
        $data =array();

        // $rate_item = add_rate_item::where('user_id',$shipment->sender_id)->where('status',$shipment->shipment_mode)->get();
        
        if($area->remote_area == '0'){
            if($shipment->special_service == '1'){
                if('0' <= $total_weight && '5' >= $total_weight){
                    $price = $rate->special_service_0_to_5_kg_price;
                }
                elseif('5.1' <= $total_weight && '10' >= $total_weight){
                    $price = $rate->special_service_5_to_10_kg_price;
                }
                elseif('10.1' <= $total_weight && '15' >= $total_weight){
                    $price = $rate->special_service_10_to_15_kg_price;
                }
                elseif('15.1' <= $total_weight && '20' >= $total_weight){
                    $price = $rate->special_service_15_to_20_kg_price;
                }
                elseif('20.1' <= $total_weight && '99999' >= $total_weight){
                    $price = (($total_weight - 20) * $rate->special_service_20_to_1000_kg_price) + $rate->special_service_15_to_20_kg_price; 
                }
            }
            else{
                if('0' <= $total_weight && '5' >= $total_weight && $shipment->shipment_mode == '1'){
                    $price = $rate->service_area_0_to_5_kg_price;
                }
                elseif('5.1' <= $total_weight && '10' >= $total_weight && $shipment->shipment_mode == '1'){
                    $price = $rate->service_area_5_to_10_kg_price;
                }
                elseif('10.1' <= $total_weight && '15' >= $total_weight && $shipment->shipment_mode == '1'){
                    $price = $rate->service_area_10_to_15_kg_price;
                }
                elseif('15.1' <= $total_weight && '20' >= $total_weight && $shipment->shipment_mode == '1'){
                    $price = $rate->service_area_15_to_20_kg_price;
                }
                elseif('20.1' <= $total_weight && '99999' >= $total_weight && $shipment->shipment_mode == '1'){
                    $price = (($total_weight - 20) * $rate->service_area_20_to_1000_kg_price) + $rate->service_area_15_to_20_kg_price; 
                }
                elseif('0' <= $total_weight && '5' >= $total_weight && $shipment->shipment_mode == '2'){
                    $price = $rate->same_day_delivery_0_to_5_kg_price;
                }
                elseif('5.1' <= $total_weight && '10' >= $total_weight && $shipment->shipment_mode == '2'){
                    $price = $rate->same_day_delivery_5_to_10_kg_price;
                }
                elseif('10.1' <= $total_weight && '15' >= $total_weight && $shipment->shipment_mode == '2'){
                    $price = $rate->same_day_delivery_10_to_15_kg_price;
                }
                elseif('15.1' <= $total_weight && '10' >= $total_weight && $shipment->shipment_mode == '2'){
                    $price = $rate->same_day_delivery_15_to_20_kg_price;
                }
                elseif('20.1' <= $total_weight && '999999' >= $total_weight && $shipment->shipment_mode == '2'){
                    $price = (($total_weight - 20) * $rate->same_day_delivery_20_to_1000_kg_price) + $rate->same_day_delivery_15_to_20_kg_price;
                }
            }
        }
        else{
            $price1=0;
            if($shipment->shipment_mode == '1'){
                $price1 = $rate->service_area_0_to_5_kg_price;
            }
            elseif($shipment->shipment_mode == '2'){
                $price1 = $rate->same_day_delivery_0_to_5_kg_price;
            }
            if('0' <= $total_weight && '5' >= $total_weight){
                $price = $rate->before_5_kg_price + $price1;
            }
            else{
                $price = (($total_weight - 5) * $rate->above_5_kg_price) + $rate->before_5_kg_price + $price1;
            }
        }

        $insurance_amount = 0;
        $cod_amount = 0;
        $vat_amount = 0;
        $postal_charge = 0;
        
        $shipment->shipment_price = $price;
        $settings = settings::find('1');
        if($rate->insurance_enable == 1){
            $insurance_amount = ($settings->insurance_percentage/100) * $shipment->declared_value;
        }

        if($rate->cod_enable == 1){
            $cod_amount = $rate->cod_price;
        }

        $sub_total = $price + $insurance_amount + $cod_amount;

        if($rate->vat_enable == 1){
            $vat_amount = ($settings->vat_percentage/100) * $sub_total;
        }
        
        if($rate->postal_charge_enable == 1){
            if($total_weight >= 30){
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

        $shipment->postal_charge_percentage = $settings->postal_charge_percentage;
        $shipment->postal_charge = $postal_charge;
        $shipment->sub_total = $sub_total;
        $shipment->vat_percentage = $settings->vat_percentage;
        $shipment->vat_amount = $vat_amount;
        $shipment->insurance_percentage = $settings->insurance_percentage;
        $shipment->insurance_amount = $insurance_amount;
        $shipment->cod_amount = $shipment->cod_amount;
        $shipment->total = $total;
        
        $shipment->revenue_exception_id = $request->agent_id;
        $shipment->revenue_exception_date = date('Y-m-d');
        $shipment->revenue_exception_time = date('H:i:s');

        $shipment->save();

    }else{
        $common_price = common_price::all();
        if(!empty($common_price)){
            foreach($common_price as $row){
                if($row->weight_from <= $total_weight && $row->weight_to >= $total_weight ){
                    $price = $row->price;
                }
            }
        }

        $insurance_amount = 0;
        $cod_amount = 0;
        $vat_amount = 0;
        $postal_charge = 0;

        $shipment->shipment_price = $price;
        $settings = settings::find('1');
        $insurance_amount = ($settings->insurance_percentage/100) * $shipment->declared_value;

        if($shipment->special_cod_enable == 1){
            $cod_amount = $settings->cod_amount;
        }

        $sub_total = $price + $insurance_amount + $cod_amount;

        $vat_amount = ($settings->vat_percentage/100) * $sub_total;
    
        if($total_weight >= 30){
            $postal_charge = 0;
        }
        else{
            $postal_charge = ($settings->postal_charge_percentage/100) * $price;
            if($postal_charge < 2){
                $postal_charge = 2;
            }
        }

        $total = $sub_total + $vat_amount + $postal_charge;

        $shipment->postal_charge_percentage = $settings->postal_charge_percentage;
        $shipment->postal_charge = $postal_charge;
        $shipment->sub_total = $sub_total;
        $shipment->vat_percentage = $settings->vat_percentage;
        $shipment->vat_amount = $vat_amount;
        $shipment->insurance_percentage = $settings->insurance_percentage;
        $shipment->insurance_amount = $insurance_amount;
        if($shipment->special_cod_enable == 1){
            $shipment->cod_amount = $settings->cod_amount;
        }
        $shipment->total = $total;
        
        $shipment->revenue_exception_id = $request->agent_id;
        $shipment->revenue_exception_date = date('Y-m-d');
        $shipment->revenue_exception_time = date('H:i:s');

        $shipment->save();
}

            $get_ip = $this->getClientIP();
            $agent = agent::find($request->agent_id);
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $request->package_id;
            $system_logs->category = 'package';
            $system_logs->to_id = $agent->email;
            $system_logs->remark = 'Revenue Exception by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            $system_logs->save();
      
           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                'package_id'=>$shipment_package->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function updatePackageException(Request $request){
        try{
            $shipment = shipment_package::find($request->shipment_id);
            $shipment->exception = 1;
            $shipment->exception_category = $request->category;
            $shipment->exception_remark = $request->remark;
            $shipment->save();
            
           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function updatePickup(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            $agent = agent::find($request->agent_id);
            
            if($request->status == 0){
                $shipment->status=2;
                $shipment->package_collect_agent_id = $request->agent_id;
                $shipment->package_collect_date = date('Y-m-d');
                $shipment->package_collect_time = date('H:i:s');

                if($shipment->sender_id == 0){
                    $agent1 = agent::find($request->agent_id);
                    $shipment->collect_cod_amount = (float)$shipment->total;
                    $agent1->total_guest = (float)$agent1->total_guest + (float)$shipment->total;
                    $agent1->save();
                }

                // if($shipment->special_cop > 0){
                //     $cop_amount=0;
                //     $cop_amount = (float)$shipment->cop_amount;
                //     $shipment->collect_cop_amount = (float)$cop_amount;
                //     $agent->total_cop = (float)$agent->total_cop + (float)$cop_amount;
                //     $agent->save();
                // }

                $shipment->save();
                
                $get_ip = $this->getClientIP();
                $system_logs = new system_logs;
                $system_logs->user_ip = $get_ip;
                $system_logs->_id = $request->shipment_id;
                $system_logs->category = 'shipment';
                $system_logs->to_id = $agent->email;
                $system_logs->remark = 'Package Collected by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
                $system_logs->save();

                $shipment_package = shipment_package::where('shipment_id',$request->shipment_id)->first();
            
                $msg= "Track ID : ".$shipment_package->sku_value." Package Collected";
                $this->sendNotificationAgent($msg,$agent->id);
                if($shipment->sender_id != 0){
                $user_notification = User::find($shipment->sender_id);
                $this->sendNotificationUser($msg,$user_notification->id);
                }

                // $from_address = manage_address::find($shipment->from_address);
                // $sms_msg= "Hi ('.$from_address->contact_name.') your package has been collected from wellwell your tracking ID for this shipment is ('.$shipment_package->sku_value.'). ";

                // $this->send_sms($from_address->contact_mobile,$sms_msg);
            }
            else{
                $shipment->status = 3;
                $shipment->exception_category = $request->category;
                $shipment->exception_remark = $request->remark;
                $shipment->pickup_exception_id = $request->agent_id;
                $shipment->exception_assign_date = date('Y-m-d');
                $shipment->exception_assign_time = date('H:i:s');
                $shipment->save();

                $get_ip = $this->getClientIP();
                $system_logs = new system_logs;
                $system_logs->user_ip = $get_ip;
                $system_logs->_id = $request->shipment_id;
                $system_logs->category = 'shipment';
                $system_logs->to_id = $agent->email;
                $system_logs->remark = 'Pickup Exception by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
                $system_logs->save();
            }

            
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function transistIn(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            $agent = agent::find($request->agent_id);
            $city = city::find($agent->city_id);

            if($request->station == 0){
                $shipment->status = 4;
                $shipment->transit_in_id = $request->agent_id;
                $shipment->transit_in_date = date('Y-m-d');
                $shipment->transit_in_time = date('H:i:s');
                $shipment->save();
            }
            elseif($request->station == 1){
                $shipment->status = 11;
                $shipment->transit_in_id1 = $request->agent_id;
                $shipment->transit_in_date = date('Y-m-d');
                $shipment->transit_in_time = date('H:i:s');
                $shipment->save();
            }
            
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $request->shipment_id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $agent->email;
            $to_station = station::find($shipment->to_station_id);
            $from_station = station::find($shipment->from_station_id);
            if($shipment->status == 4){
                $system_logs->remark = 'Transit In to '.$from_station->station.' by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            }
            else{
                $system_logs->remark = 'Transit In to '.$to_station->station.' by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            }
            $system_logs->save();

            $shipment_package = shipment_package::where('shipment_id',$request->shipment_id)->first();
            $msg= "Track ID : ".$shipment_package->sku_value." Transit In Collected";
            $this->sendNotificationAgent($msg,$agent->id);
            if($shipment->sender_id != 0){
            $user_notification = User::find($shipment->sender_id);
            $this->sendNotificationUser($msg,$user_notification->id);
            }

           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function transistOut(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            
            $agent = agent::find($request->agent_id);
            $city = city::find($agent->city_id);
           
            if($request->station == 0){
                $shipment->status = 6;
                $shipment->transit_out_id = $request->agent_id;
            }
            elseif($request->station == 1){
                $shipment->status = 12;
                $shipment->transit_out_id1 = $request->agent_id;
            }

            $shipment->transit_out_date = date('Y-m-d');
            $shipment->transit_out_time = date('H:i:s');
            $shipment->save();

            //$agent = agent::find($request->agent_id);
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $request->shipment_id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $agent->email;
            $to_station = station::find($shipment->to_station_id);
            $from_station = station::find($shipment->from_station_id);
            if($shipment->status >= 4){
                $system_logs->remark = 'Transit Out to '.$from_station->station.' by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            }
            else{
                $system_logs->remark = 'Transit Out to '.$to_station->station.' by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            }
            
            $system_logs->save();

            $shipment_package = shipment_package::where('shipment_id',$request->shipment_id)->first();
            $msg= "Track ID : ".$shipment_package->sku_value." Transit Out Collected";
            $this->sendNotificationAgent($msg,$agent->id);
            if($shipment->sender_id != 0){
            $user_notification = User::find($shipment->sender_id);
            $this->sendNotificationUser($msg,$user_notification->id);
            }

           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function packageAtStation(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            
            $agent = agent::find($request->agent_id);
            $city = city::find($agent->city_id);
            if($request->station == 0){
                $shipment->status = 13;
                $shipment->package_at_station_id = $request->agent_id;
            }
            elseif($request->station == 1){
                $shipment->status = 14;
                $shipment->package_at_station_id1 = $request->agent_id;
            }
            // if($shipment->from_station_id == $city->station_id){
            //     $shipment->status = 13;
            //     $shipment->package_at_station_id = $request->agent_id;
            // }
            // elseif($shipment->to_station_id == $city->station_id){
            //     $shipment->status = 14;
            //     $shipment->package_at_station_id1 = $request->agent_id;
            // }

            $shipment->package_at_station_date = date('Y-m-d');
            $shipment->package_at_station_time = date('H:i:s');
            $shipment->save();

            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $request->shipment_id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $agent->email;
            $to_station = station::find($shipment->to_station_id);
            $from_station = station::find($shipment->from_station_id);
            if($shipment->status == 13){
                $system_logs->remark = 'Package At Station to '.$from_station->station.' by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            }
            else{
                $system_logs->remark = 'Package At Station to '.$to_station->station.' by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            }
            $system_logs->save();

            $shipment_package = shipment_package::where('shipment_id',$request->shipment_id)->first();
            $msg= "Track ID : ".$shipment_package->sku_value." Package At Station Collected";
            $this->sendNotificationAgent($msg,$agent->id);
            if($shipment->sender_id != 0){
            $user_notification = User::find($shipment->sender_id);
            $this->sendNotificationUser($msg,$user_notification->id);
            }

            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function vanScan(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            
            $shipment->status = 7;
            $shipment->van_scan_id = $request->agent_id;
            $shipment->van_scan_date = date('Y-m-d');
            $shipment->van_scan_time = date('H:i:s');
            $shipment->save();

            $agent = agent::find($request->agent_id);
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $request->shipment_id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $agent->email;
            $system_logs->remark = 'Van Scan by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            $system_logs->save();

            $shipment_package = shipment_package::where('shipment_id',$request->shipment_id)->first();
            $msg= "Track ID : ".$shipment_package->sku_value." Van Scan Successfully";
            $this->sendNotificationAgent($msg,$agent->id);
            if($shipment->sender_id != 0){
            $user_notification = User::find($shipment->sender_id);
            $this->sendNotificationUser($msg,$user_notification->id);
            }

            // $to_address = manage_address::find($shipment->to_address);
            // $sms_msg= "Hi ('.$to_address->contact_name.') your package has been delivered from wellwell your tracking ID for this shipment is ('.$shipment_package->sku_value.'). ";

            // $this->send_sms($to_address->contact_mobile,$sms_msg);

            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function updateDelivery(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            $shipment->status = 8;
            $shipment->delivery_agent_id = $request->agent_id;
            $shipment->delivery_date = date('Y-m-d');
            $shipment->delivery_time = date('H:i:s');

            $agent = agent::find($request->agent_id);
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $request->shipment_id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $agent->email;
            $system_logs->remark = 'Shipment Delivered by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            $system_logs->save();

            $shipment->cod_type = $request->cod_type;
            if($request->cod_type == 'Credit Card'){
            $shipment->credit_verification_code = $request->credit_verification_code;
            $shipment->last_four_digit = $request->last_four_digit;
            }

            $cod_amount=0;
            if(isset($request->cod_amount)){
                $cod_amount = (float)$request->cod_amount;
                $shipment->collect_cod_amount = (float)$cod_amount;
                $shipment->delivery_notes = $request->delivery_notes;

                $agent->total_cod = (float)$agent->total_cod + (float)$cod_amount;
                $agent->save();

                if($shipment->special_cod_enable == 1){
                    if($shipment->sender_id != 0){
                        $user = User::find($shipment->sender_id);
                        $cod=0;
                        if($shipment->special_cod != 'null' && $shipment->special_cod != ''){
                            $cod= (float)($shipment->special_cod);
                        }
                        $user->total = $user->total + $cod;
                        $user->save();
                    }
                }
            }

            $shipment->receiver_signature = 'data:image/png;base64,'.$request->receiver_signature;
            // $shipment->receiver_signature_name = $request->signature_name;

            $shipment->signature_person_name = $request->signature_person_name;
            $shipment->delivery_address = $request->delivery_address;

            $shipment->save();

            $shipment_package1 = shipment_package::where('shipment_id',$request->shipment_id)->first();
            $msg= "Track ID : ".$shipment_package1->sku_value." Delivered Successfully";
            $this->sendNotificationAgent($msg,$agent->id);
            if($shipment->sender_id != 0){
            $user_notification = User::find($shipment->sender_id);
            $this->sendNotificationUser($msg,$user_notification->id);
            }

            // $to_address = manage_address::find($shipment->to_address);
            // $sms_msg= "Hi ('.$to_address->contact_name.') your package has been delivered from wellwell your tracking ID for this shipment is ('.$shipment_package1->sku_value.'). ";

            // $this->send_sms($to_address->contact_mobile,$sms_msg);
            

            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function updateReturnShipper(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            $shipment->status = 15;
            $shipment->return_shipment_id = $request->agent_id;
            $shipment->return_shipment_date = date('Y-m-d');
            $shipment->return_shipment_time = date('H:i:s');
            $shipment->return_notes = $request->return_notes;

            $agent = agent::find($request->agent_id);
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $request->shipment_id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $agent->email;
            $system_logs->remark = 'Shipment Return to Shipper by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            $system_logs->save();

            $shipment->save();

            $shipment_package1 = shipment_package::where('shipment_id',$request->shipment_id)->first();
            $msg= "Track ID : ".$shipment_package1->sku_value." Return to Shipper Successfully";
            $this->sendNotificationAgent($msg,$agent->id);
            if($shipment->sender_id != 0){
            $user_notification = User::find($shipment->sender_id);
            $this->sendNotificationUser($msg,$user_notification->id);
            }            

            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function changeOwnership(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            if($shipment->status == 1){
                $shipment->pickup_agent_id = $request->agent_id;
                $shipment->pickup_assign_date = date('Y-m-d');
                $shipment->pickup_assign_time = date('H:i:s');
            }
            elseif($shipment->status == 2){
                $shipment->package_collect_agent_id = $request->agent_id;
                $shipment->package_collect_date = date('Y-m-d');
                $shipment->package_collect_time = date('H:i:s');
            }
            elseif($shipment->status == 4){
                $shipment->transit_in_id = $request->agent_id;
                $shipment->transit_in_date = date('Y-m-d');
                $shipment->transit_in_time = date('H:i:s');
            }
            elseif($shipment->status == 11){
                $shipment->transit_in_id1 = $request->agent_id;
                $shipment->transit_in_date = date('Y-m-d');
                $shipment->transit_in_time = date('H:i:s');
            }
            elseif($shipment->status == 6){
                $shipment->transit_out_id = $request->agent_id;
                $shipment->transit_out_date = date('Y-m-d');
                $shipment->transit_out_time = date('H:i:s');
            }
            elseif($shipment->status == 12){
                $shipment->transit_out_id1 = $request->agent_id;
                $shipment->transit_out_date = date('Y-m-d');
                $shipment->transit_out_time = date('H:i:s');
            }
            elseif($shipment->status == 13){
                $shipment->package_at_station_id = $request->agent_id;
                $shipment->package_at_station_date = date('Y-m-d');
                $shipment->package_at_station_time = date('H:i:s');
            }
            elseif($shipment->status == 14){
                $shipment->package_at_station_id = $request->agent_id;
                $shipment->package_at_station_date = date('Y-m-d');
                $shipment->package_at_station_time = date('H:i:s');
            }
            elseif($shipment->status == 7){
                $shipment->van_scan_id = $request->agent_id;
                $shipment->van_scan_date = date('Y-m-d');
                $shipment->van_scan_time = date('H:i:s');
            }
            elseif($shipment->status == 8){
                $shipment->delivery_agent_id = $request->agent_id;
                $shipment->delivery_date = date('Y-m-d');
                $shipment->delivery_time = date('H:i:s');
            }

            $agent = agent::find($request->agent_id);
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $request->shipment_id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $agent->email;
            $system_logs->remark = 'Shipment Change Ownership to Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            $system_logs->save();

            $shipment->save();

            $shipment_package1 = shipment_package::where('shipment_id',$request->shipment_id)->first();
            $msg= "Track ID : ".$shipment_package1->sku_value." Change Ownership Successfully";
            $this->sendNotificationAgent($msg,$agent->id);

            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function deliveryException(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            
            $shipment->status = 9;
            $shipment->delivery_exception_id = $request->agent_id;
            if($request->category == 'Reschedule Delivery'){
                $shipment->delivery_reschedule = 1;
                $shipment->delivery_reschedule_date = $request->date;
            }
            $shipment->delivery_exception_category = $request->category;
            $shipment->delivery_exception_remark = $request->remark;
            $shipment->delivery_exception_assign_date = date('Y-m-d');
            $shipment->delivery_exception_assign_time = date('H:i:s');
            $shipment->save();

            $agent = agent::find($request->agent_id);
            $get_ip = $this->getClientIP();
            $system_logs = new system_logs;
            $system_logs->user_ip = $get_ip;
            $system_logs->_id = $request->shipment_id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $agent->email;
            $system_logs->remark = 'Delivery Exception by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            $system_logs->save();
            
           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }



    public function changePassword(Request $request){
        $agent = agent::find($request->agent_id);
        $hashedPassword = $agent->password;
 
        if (\Hash::check($request->oldpassword , $hashedPassword )) {
            if (!\Hash::check($request->password , $hashedPassword)) {
                $agent->password = Hash::make($request->password);
                $agent->save();
                return response()->json(['message' => 'Successfully Update'], 200);
            }
            else{
                return response()->json(['message' => 'new password can not be the old password!','status'=>400], 400);
            }
        }
        else{
            return response()->json(['message' => 'old password doesnt matched','status'=>400], 400);
        }
    }

    public function scanPackage(Request $request){ 
        //return response()->json($request);
        try{
            $exist = shipment::where('order_id',$request->order_id)->get();
        //return response()->json(count($exist));
        if(count($exist)>0){
        // $pickup = shipment::where('order_id',$exist[0]->order_id)->where('pickup_agent_id',$request->agent_id)->where('status',1)->first();

        // $delivery = shipment::where('order_id',$exist[0]->order_id)->where('delivery_agent_id',$request->agent_id)->where('status',7)->first();
            foreach($exist as $row){
                if($row->pickup_agent_id == $request->agent_id && $row->status == 1){
                    return response()->json(['message' => 'Successfully Send','shipment_id'=>$row->id,'shipment_status'=>$row->status,'status'=>0], 200);
                }
                elseif($row->delivery_agent_id == $request->agent_id && $row->status == 7){
                    return response()->json(['message' => 'Successfully Send','shipment_id'=>$row->id,'shipment_status'=>$row->status,'status'=>1], 200);
                }
                else{
                    return response()->json(['message' => 'Status Not Available','status'=>400], 400);
                }
            }
       
            }else{
                return response()->json(['message' => 'Shipment Not Available','status'=>403], 403);
            }
        
        }catch (\Exception $e) {
            //return response()->json($e);
            return response()->json(['message' => 'Shipment Not Available','status'=>400], 400);
        }
    }

    public function scanPackageSku(Request $request){ 
        //return response()->json($request);
        try{
            //$check1 = shipment_package::where('sku_value',$request->barcode)->get();

            $q =DB::table('shipment_packages as sp');
            $q->where('sp.sku_value', $request->barcode);
            $q->join('shipments as s','s.id','=','sp.shipment_id');
            $q->select('s.status as shipment_status','sp.*');
            $check1 = $q->get();

        
        if(count($check1)>0){
            if($check1[0]->status != '10'){
                $data = array('shipment_id' => (int)$check1[0]->shipment_id,
                'package_id' => $check1[0]->id,'shipment_status'=>$check1[0]->shipment_status);
                $datas[]=$data;
                return response()->json($datas, 200);
            }else{
                return response()->json(['message' => 'Shipment Canceled','status'=>500], 500);
            }
        }else{
            return response()->json(['message' => 'Shipment Not Available','status'=>403], 403);
        }
        
        
        }catch (\Exception $e) {
            //return response()->json($e);
            return response()->json(['message' => 'Shipment Not Available','status'=>400], 400);
        }
    }


    public function barcodePackage(Request $request){ 
        //return response()->json($request);
        try{
            //$check1 = shipment_package::where('sku_value',$request->barcode)->get();
        $q =DB::table('shipment_packages as sp');
        $q->where('sp.sku_value', $request->barcode);
        $q->join('shipments as s','s.id','=','sp.shipment_id');
        $q->select('s.status','sp.*');
        $check1 = $q->get();


        if(count($check1)>0){
            //if($check1[0]->status != '8'){
                if($check1[0]->status != '10'){
                    $data = array(
                    'id'=>$check1[0]->id,
                    'barcode_package'=>$check1[0]->sku_value,
                    'weight'=>$check1[0]->weight,
                    'length'=>$check1[0]->length,
                    'width'=>$check1[0]->width,
                    'height'=>$check1[0]->height,
                    );
                    $datas[]=$data;
                    return response()->json($datas, 200);
                }else{
                    return response()->json(['message' => 'Shipment Canceled','status'=>401], 401);
                }
            // }else{
            //     return response()->json(['message' => 'Shipment Already Delivered','status'=>401], 401);
            // }
        }else{
            return response()->json(['message' => 'Shipment Not Available','status'=>403], 403);
        }
        
        
        }catch (\Exception $e) {
           // return response()->json($e);
            return response()->json(['message' => 'Shipment Not Available','status'=>400], 400);
        }
    }


    public function barcodeScan(Request $request){ 
        //return response()->json($request);
        try{
           // $check1 = shipment_package::where('sku_value',$request->barcode)->first();
            $q =DB::table('shipment_packages as sp');
            $q->where('sp.sku_value', $request->barcode);
            $q->join('shipments as s','s.id','=','sp.shipment_id');
            $q->select('s.status','sp.*');
            $check1 = $q->first();
            $check2 = shipment::where('order_id',$request->barcode)->first();
                $shipment_id='';
                if(!empty($check1)){
                    $shipment_id = $check1->shipment_id;
                }
                elseif(!empty($check2)){
                    $shipment_id = $check2->id;
                }
                $shipment = shipment::find($shipment_id);
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->first();
                $data = array(
                'no_of_packages'=> (int)$shipment->no_of_packages,
                'shipment_id'=>$shipment->order_id,
                'tracking_id'=>$shipment_package->sku_value,
                'id'=>$shipment->id,
                'status'=>'',
                'user_type'=>'',
                );
                if($shipment->sender_id != 0){
                    $data['user_type']=1;
                }
                else{
                    $data['user_type']=0;
                }
                if($shipment->hold_status == 1){
                    $data['status']='5';
                }
                else{
                    $data['status']=$shipment->status;
                }
                $datas[]=$data;
                
                return response()->json($datas);
        
        }catch (\Exception $e) {
            //return response()->json($e);
            return response()->json(['message' => 'Shipment Not Available','status'=>400], 400);
        }
    }


    public function mobilePrintLabel($id){
        $shipment = shipment::find($id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();

        $shipment_count = shipment_package::where('shipment_id',$id)->count();

        $all_shipments = DB::table("shipment_packages as sp")
        ->where("sp.shipment_id",$id)
        ->join('shipments as s', 's.id', '=', 'sp.shipment_id')
        ->join('stations as st', 'st.id', '=', 's.to_station_id')
        ->select('s.*','sp.sku_value','sp.length','sp.width','sp.height','sp.category','sp.description','st.station')
        //->groupBy("users.id")
        ->get();

        $country = country::all();
        $user = User::find($shipment->sender_id);
        $package_category = package_category::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $from_address = manage_address::find($shipment->from_address);
        $to_address = manage_address::find($shipment->to_address);

        $pdf = PDF::loadView('print.mobile_print_label',compact('shipment','shipment_package','country','city','area','from_address','to_address','shipment_count','all_shipments','user','package_category'));
        $pdf->setPaper('A4');
        return $pdf->stream('report.pdf');

        // $view = view('print.printlabel',compact('shipment','shipment_package','country','city','area','from_address','to_address','shipment_count','all_shipments'))->render();

        // return response()->json($view);
    }


    public function exceptionCategory($status){
        $exception_category = exception_category::where('exception_status',$status)->where('status',0)->get();
        $datas =array();
        foreach ($exception_category as $key => $value) {
            $datas[] = $value->category;
        }   
        return response()->json($datas); 
    }


    public function getTodayStation(){
        $today = date('Y-m-d');
        $shipment = shipment::where('date',$today)->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_station = station::find($value->from_station_id);
            $to_station = station::find($value->to_station_id);
            $data = array(
                'id' => $value->id,
                'order_id' => $value->order_id,
                'from_station' => $from_station->station,
                'to_station' => $to_station->station,
                'status' => '',
            );
            if($value->status == 0){
                $data['status'] = 'Shipment Created';
            }
            elseif($value->status == 1){
                $data['status'] = 'Pickup Assigned';
            }
            elseif($value->status == 2){
                $data['status'] = 'Package Collected';
            }
            elseif($value->status == 3){
                $data['status'] = 'Exception';
            }
            elseif($value->status == 4){
                $data['status'] = 'Transit In';
            }
            elseif($value->status == 5){
                $data['status'] = 'Assign Agent to Transit Out (Hub)';
            }
            elseif($value->status == 6){
                $data['status'] = 'Transit Out';
            }
            elseif($value->status == 7){
                $data['status'] = 'Assign Agent to Delivery';
            }
            elseif($value->status == 8){
                $data['status'] = 'Shipment delivered';
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getTodayData($id){
        $today = date('Y-m-d');
        //$total_shipment = shipment::where('date',$today)->where('pickup_agent_id',$id)->orWhere('delivery_agent_id',$id)->count();

        $total_shipment_value = shipment::where('delivery_date', $today)->where('delivery_agent_id',$id)->where('status',8)->get()->sum("special_cod");

        $collected_value = shipment::where('delivery_date', $today)->where('delivery_agent_id',$id)->where('status',8)->get()->sum("collect_cod_amount");

        $i =DB::table('shipments');
        $i->where('shipments.pickup_agent_id', $id);
        $i->orWhere('shipments.package_collect_agent_id', $id);
        $i->orWhere('shipments.pickup_exception_id', $id);
        $i->orWhere('shipments.package_collect_agent_id', $id);
        $i->orWhere('shipments.transit_in_id', $id);
        $i->orWhere('shipments.revenue_exception_id', $id);
        $i->orWhere('shipments.transit_out_id', $id);
        $i->orWhere('shipments.package_at_station_id', $id);
        $i->orWhere('shipments.van_scan_id', $id);
        $i->orWhere('shipments.delivery_agent_id', $id);
        $i->orWhere('shipments.delivery_exception_id', $id);
        $shipment = $i->get();

        $on_pickup = 0;
        $pickup = 0;
        $exception = 0;
        $hub=0;
        $delivery=0;
        $completed = 0;
        $total_shipment = 0;

        foreach($shipment as $row){
            if($row->status == 1 && $row->pickup_agent_id == $id && $row->pickup_assign_date == $today){
                $on_pickup++;
            }
            elseif($row->status == 2 && $row->package_collect_agent_id == $id && $row->package_collect_date == $today){
                $pickup++;
            }
            elseif($row->status == 3 && $row->pickup_exception_id == $id && $row->exception_assign_date == $today){
                $exception++;
            }
            elseif($row->status == 4 && $row->transit_in_id == $id && $row->transit_in_date == $today){
                $hub++;
            }
            elseif($row->status == 6 && $row->transit_out_id == $id && $row->transit_out_date == $today){
                $hub++;
            }
            elseif($row->status == 11 && $row->transit_in_id == $id && $row->transit_in_date == $today){
                $hub++;
            }
            elseif($row->status == 12 && $row->transit_out_id == $id && $row->transit_out_date == $today){
                $hub++;
            }
            elseif($row->status == 7 && $row->van_scan_id == $id && $row->van_scan_date == $today){
                $delivery++;
            }
            elseif($row->status == 8 && $row->delivery_agent_id == $id && $row->delivery_date == $today){
                $completed++;
            }
        }
        $total_shipment = $on_pickup + $pickup + $exception + $hub + $delivery + $completed;


        $data = array(
            'total_shipment' => $total_shipment,
            'total_shipment_value' => 0,
            'collected_value' => (int)$collected_value,
            'on_pickup' => $on_pickup,
            'pickup' => $pickup,
            'exception' => $exception,
            'hub' => $hub,
            'delivery' => $delivery,
            'completed' => $completed,
        );
   
        return response()->json($data); 
    }


    public function getExceptionShipment(){
        $today = date('Y-m-d');
        $shipment = shipment::where('status',3)->orWhere('status',9)->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_station = station::find($value->from_station_id);
            $to_station = station::find($value->to_station_id);
            $data = array(
                'id' => $value->id,
                'order_id' => $value->order_id,
                'from_station' => $from_station->station,
                'to_station' => $to_station->station,
            );
            
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getExceptionDetails($id){
        $today = date('Y-m-d');
        $shipment = shipment::find($id);

        if($shipment->status == '3'){
            if($shipment->exception_category != null){
                $data['exception_category'] = $shipment->exception_category;
            }
            if($shipment->exception_remark != null){
                $data['exception_remark'] = $shipment->exception_remark;
            }
        }
        elseif($shipment->status == '9'){
            if($shipment->delivery_exception_category != null){
                $data['exception_category'] = $shipment->delivery_exception_category;
            }
            if($shipment->delivery_exception_remark != null){
                $data['exception_remark'] = $shipment->delivery_exception_remark;
            }
        }

        return response()->json($data); 
    }



    public function printTodayData($id){

        $today = date('Y-m-d');
        //$total_shipment = shipment::where('date',$today)->where('pickup_agent_id',$id)->orWhere('delivery_agent_id',$id)->count();

        $total_shipment_value = shipment::where('delivery_date', $today)->where('delivery_agent_id',$id)->where('status',8)->get()->sum("special_cod");

        $collected_value = shipment::where('delivery_date', $today)->where('delivery_agent_id',$id)->where('status',8)->get()->sum("collect_cod_amount");

        $collected_guest = shipment::where('package_collect_date', $today)->where('package_collect_agent_id',$id)->where('sender_id',0)->get()->sum("collect_cod_amount");

        $i =DB::table('shipments');
        $i->where('shipments.pickup_agent_id', $id);
        $i->orWhere('shipments.package_collect_agent_id', $id);
        $i->orWhere('shipments.pickup_exception_id', $id);
        $i->orWhere('shipments.package_collect_agent_id', $id);
        $i->orWhere('shipments.transit_in_id', $id);
        $i->orWhere('shipments.revenue_exception_id', $id);
        $i->orWhere('shipments.transit_out_id', $id);
        $i->orWhere('shipments.package_at_station_id', $id);
        $i->orWhere('shipments.van_scan_id', $id);
        $i->orWhere('shipments.delivery_agent_id', $id);
        $i->orWhere('shipments.delivery_exception_id', $id);
        $shipment = $i->get();

        $on_pickup = 0;
        $pickup = 0;
        $exception = 0;
        $hub=0;
        $delivery=0;
        $completed = 0;
        $total_shipment = 0;

        foreach($shipment as $row){
            if($row->status == 1 && $row->pickup_agent_id == $id && $row->pickup_assign_date == $today){
                $on_pickup++;
            }
            elseif($row->status == 2 && $row->package_collect_agent_id == $id && $row->package_collect_date == $today){
                $pickup++;
            }
            elseif($row->status == 3 && $row->pickup_exception_id == $id && $row->exception_assign_date == $today){
                $exception++;
            }
            elseif($row->status == 4 && $row->transit_in_id == $id && $row->transit_in_date == $today){
                $hub++;
            }
            elseif($row->status == 6 && $row->transit_out_id == $id && $row->transit_out_date == $today){
                $hub++;
            }
            elseif($row->status == 11 && $row->transit_in_id == $id && $row->transit_in_date == $today){
                $hub++;
            }
            elseif($row->status == 12 && $row->transit_out_id == $id && $row->transit_out_date == $today){
                $hub++;
            }
            elseif($row->status == 7 && $row->van_scan_id == $id && $row->van_scan_date == $today){
                $delivery++;
            }
            elseif($row->status == 8 && $row->delivery_agent_id == $id && $row->delivery_date == $today){
                $completed++;
            }
        }
        $total_shipment = $on_pickup + $pickup + $exception + $hub + $delivery + $completed;

        $shipment_new = shipment::where('date','=',$today)->get();     
        
        $datas =array();
        foreach ($shipment_new as $key => $value) {
            $shipment_package = shipment_package::where('shipment_id',$value->id)->get();
            $from_station = station::find($value->from_station_id);
            $to_station = station::find($value->to_station_id);
            $data = array(
                'id' => $value->id,
                'order_id' => $shipment_package[0]->sku_value,
                'from_station' => $from_station->station,
                'to_station' => $to_station->station,
                'status' => '',
            );
            if($value->status == 0){
                $data['status'] = 'New Request';
            }
            elseif($value->status == 1){
                $data['status'] = 'Pickup Assigned';
            }
            elseif($value->status == 2){
                $data['status'] = 'Package Collected';
            }
            elseif($value->status == 3){
                $data['status'] = 'Pickup Exception';
            }
            elseif($value->status == 4){
                $data['status'] = 'Transit In';
            }
            elseif($value->status == 6){
                $data['status'] = 'Transit Out';
            }
            elseif($value->status == 11){
                $data['status'] = 'Transit In';
            }
            elseif($value->status == 12){
                $data['status'] = 'Transit Out';
            }
            elseif($value->status == 7){
                $data['status'] = 'In the Van for Delivery';
            }
            elseif($value->status == 8){
                $data['status'] = 'Shipment delivered';
            }
            elseif($value->status == 9){
                $data['status'] = 'Delivery Exception';
            }
            $datas[] = $data;
        }   

        $collected_cash_value = shipment::where('delivery_date', $today)->where('delivery_agent_id',$id)->where('cod_type','Cash')->where('status',8)->get()->sum("collect_cod_amount");
        $collected_credit_value = shipment::where('delivery_date', $today)->where('delivery_agent_id',$id)->where('cod_type','Credit Card')->where('status',8)->get()->sum("collect_cod_amount");
        $collected_bank_value = shipment::where('delivery_date', $today)->where('delivery_agent_id',$id)->where('cod_type','Bank Transfer')->where('status',8)->get()->sum("collect_cod_amount");

        $delivery_shipment = shipment::where('delivery_agent_id', $id)->where('special_cod_enable', 1)->where('delivery_date', $today)->where('status',8)->get();
        $shipment_package = shipment_package::all();

        $agent = agent::find($id);

        $shipment_data = array(
            'total_shipment' => $total_shipment,
            'total_shipment_value' => $total_shipment_value,
            'collected_value' => $collected_value,
            'on_pickup' => $on_pickup,
            'pickup' => $pickup,
            'exception' => $exception,
            'hub' => $hub,
            'delivery' => $delivery,
            'completed' => $completed,
            'collected_guest' => $collected_guest,
            'collected_bank_value' => $collected_bank_value,
            'collected_credit_value' => $collected_credit_value,
            'collected_cash_value' => $collected_cash_value,
        );
   
        $pdf = PDF::loadView('print.mobile_today_data',compact('shipment_data','datas','agent','delivery_shipment','shipment_package'));
        $pdf->setPaper('A4');
        return $pdf->stream('report.pdf');

        //return response()->json($datas); 

    }

public function dummyRecordCreate($count){
    $data = array(
        'status'=>0,
        'weight'=>0,
        'length'=>0,
        'width'=>0,
        'height'=>0,
        'dim'=>0,
        'chargeable_weight'=>0,
        'category'=>'',
        'description'=>''
    );
    $datas =array();
    for($i=0;$i<$count;$i++){
        $datas[]=$data;
    }
     return response()->json($datas); 
}


}
