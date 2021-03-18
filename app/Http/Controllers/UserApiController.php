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
use App\Models\temp_shipment;
use App\Models\temp_shipment_package;
use App\Models\weeks;
use App\Models\user_settlement;
use App\Models\invoice;
use App\Models\invoice_pay;
use Hash;
use Mail;
use PDF;
use DB;
use App\Exports\UserShipmentExport;
use App\Exports\UserRevenueExport;
use Maatwebsite\Excel\Facades\Excel;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class UserApiController extends Controller
{
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

    public function userLogin(Request $request){
        $exist = User::where('email',$request->email)->get();
        if(count($exist)>0){
            if($exist[0]->status == 4){
                if(Hash::check($request->password,$exist[0]->password)){
                    $user = User::find($exist[0]->id);
                    $user->firebase_key = $request->firebase_key;
                    $user->save();

                return response()->json(['message' => 'Login Successfully',
                'user_id'=>$exist[0]->id,
                'name'=>$exist[0]->first_name.$exist[0]->last_name,
                'status'=>200], 200);
                }else{
                    return response()->json(['message' => 'Records Does not Match','status'=>403], 403);
                }
            }else{
                return response()->json(['message' => 'Verify Your Account','status'=>401,'user_id'=>$exist[0]->id], 401);
            }
        }else{
            return response()->json(['message' => 'This Email Address Not Registered','status'=>404], 404);
        }
    }

    public function Tracking(Request $request){ 
        try{
            //$check1 = shipment_package::where('sku_value',$request->barcode)->get();

            $q =DB::table('shipment_packages as sp');
            $q->where('sp.sku_value', $request->sku_value);
            $q->join('shipments as s','s.id','=','sp.shipment_id');
            $q->select('s.*','sp.sku_value');
            $check1 = $q->get();
        
            if(count($check1)>0){
            $from_address =manage_address::find($check1[0]->from_address);
            $to_address =manage_address::find($check1[0]->to_address);

            $from_area = city::find($from_address->area_id);
            $from_city = city::find($from_address->city_id);
            $to_area = city::find($to_address->area_id);
            $to_city = city::find($to_address->city_id);

                $data = array(
                    'id'=>$check1[0]->id,
                    'sku_value'=>$check1[0]->sku_value,
                    'from_area'=>$from_area->city,
                    'from_city'=>$from_city->city,
                    'to_area'=>$to_area->city,
                    'to_city'=>$to_city->city,
                    'status'=>'',
                    'mode'=>'',
                    );
                if($check1[0]->shipment_mode == 1){
                    $data['mode'] = 'standard';
                }
                else{
                    $data['mode'] = 'express';
                }

                if($check1[0]->status == 0){
                    $data['status'] = 'Shipment Created';
                }
                elseif($check1[0]->status == 1){
                    $data['status'] = 'Pickup Assigned';
                }
                elseif($check1[0]->status == 2){
                    $data['status'] = 'Package Collected';
                }
                elseif($check1[0]->status == 3){
                    $data['status'] = 'Pickup Exception';
                }
                elseif($check1[0]->status == 4){
                    $data['status'] = 'Transit In';
                }
                elseif($check1[0]->status == 11){
                    $data['status'] = 'Transit In';
                }
                elseif($check1[0]->status == 6){
                    $data['status'] = 'Transit Out';
                }
                elseif($check1[0]->status == 12){
                    $data['status'] = 'Transit Out';
                }
                elseif($check1[0]->status == 7){
                    $data['status'] = 'In the Van to Delivery';
                }
                elseif($check1[0]->status == 8){
                    $data['status'] = 'Shipment Delivered';
                }
                elseif($check1[0]->status == 9){
                    $data['status'] = 'Delivery Exception';
                }
                elseif($check1[0]->status == 10){
                    $data['status'] = 'Shipment Canceled';
                }

                $datas[]=$data;
                return response()->json($datas, 200);

            }else{
                return response()->json(['message' => 'Shipment Not Available','status'=>403], 403);
            }
        
        }catch (\Exception $e) {
            return response()->json($e);
            return response()->json(['message' => 'Shipment Not Available','status'=>400], 400);
        }
    }

    public function trackHistory($id){
        $shipment = shipment::find($id);
        $data =array();
        $from_station = station::find($shipment->from_station_id);
        $to_station = station::find($shipment->to_station_id);
        $data = array(
            'date_time' => '',
            'value' => '',
        );
        if($shipment->status != 10){
            if($shipment->status == 9 && $shipment->status < 11 && $shipment->status != 10){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->delivery_exception_assign_date)) .'-'. date('H:m a',strtotime($shipment->delivery_exception_assign_time));
                $data['value'] = $shipment->delivery_exception_category .'-'. $shipment->delivery_exception_remark;
                $datas[] = $data;
            }
            if($shipment->status >= 8 && $shipment->status < 11 && $shipment->status != 10 && $shipment->status != 9){
                if(!empty($shipment->delivery_date)){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->delivery_date)) .'-'. date('H:m a',strtotime($shipment->delivery_time));
                $data['value'] = 'Shipment Delivered';
                $datas[] = $data;
                }
            }
            if($shipment->status >= 7 && $shipment->status < 11 && $shipment->status != 10 && $shipment->status != 9){
                if(!empty($shipment->van_scan_date)){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->van_scan_date)) .'-'. date('H:m a',strtotime($shipment->van_scan_time));
                $data['value'] = 'In the Van for Delivery';
                $datas[] = $data;
                }
            }
            if(6 < $shipment->status && 12 == $shipment->status && $shipment->status != 10 && $shipment->status != 9){
                if(!empty($shipment->transit_out_date)){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->transit_out_date)) .'-'. date('H:m a',strtotime($shipment->transit_out_time));
                $data['value'] = 'Transit Out' . $to_station->station;
                $datas[] = $data;
                }
            }
            if(6 < $shipment->status && 11 == $shipment->status && $shipment->status != 10 && $shipment->status != 9){
                if(!empty($shipment->transit_in_date)){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->transit_in_date)) .'-'. date('H:m a',strtotime($shipment->transit_in_time));
                $data['value'] = 'Transit In' . $to_station->station;
                $datas[] = $data;
                }
            }
            if($shipment->status >= 6 && $shipment->status != 10 && $shipment->status != 9){
                if(!empty($shipment->transit_out_date)){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->transit_out_date)) .'-'. date('H:m a',strtotime($shipment->transit_out_time));
                $data['value'] = 'Transit Out' . $to_station->station;
                $datas[] = $data;
                }
            }
            if($shipment->status >= 4 && $shipment->status != 10 && $shipment->status != 9){
                if(!empty($shipment->transit_in_date)){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->transit_in_date)) .'-'. date('H:m a',strtotime($shipment->transit_in_time));
                $data['value'] = 'Transit In' . $to_station->station;
                $datas[] = $data;
                }
            }
            if($shipment->status == 3 && $shipment->status != 10 && $shipment->status != 9){
                if(!empty($shipment->exception_assign_date)){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->exception_assign_date)) .'-'. date('H:m a',strtotime($shipment->exception_assign_time));
                $data['value'] = $shipment->eception_category .'-'. $shipment->eception_remark;
                $datas[] = $data;
                }
            }
            if($shipment->status >= 2 && $shipment->status != 10 && $shipment->status != 9){
                if(!empty($shipment->package_collect_date)){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->package_collect_date)) .'-'. date('H:m a',strtotime($shipment->package_collect_time));
                $data['value'] = 'Package Collected';
                $datas[] = $data;
                }
            }
            if($shipment->status >= 1 && $shipment->status != 10 && $shipment->status != 9){
                if(!empty($shipment->pickup_assign_date)){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->pickup_assign_date)) .'-'. date('H:m a',strtotime($shipment->pickup_assign_time));
                $data['value'] = 'Schedule for Pickup';
                $datas[] = $data;
                }
            }
            if($shipment->status >= 0 && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y H:m a',strtotime($shipment->created_at));
                $data['value'] = 'Shipment Created';
                $datas[] = $data;
            }
        }else{
            $data['date_time'] = date('d-m-Y',strtotime($shipment->cancel_request_date)) .'-'. date('H:m a',strtotime($shipment->cancel_request_time));
            $data['value'] = 'Shipment Canceled';
            $datas[] = $data;
        }
        return response()->json($datas); 
    }

    public function getCity(){ 
        $data = city::where('parent_id',0)->where('status',0)->get();
        $datas =array();
        foreach($data as $row){
            $datas[]=$row->city;
        }
        return response()->json($datas); 
    }

    public function getArea($id){ 
        $city = city::where('parent_id',0)->where('city',$id)->first();
        $data = city::where('parent_id',$city->id)->where('status',0)->orderBy('city','ASC')->get();
        $datas =array();
        foreach($data as $row){
            $datas[]=$row->city;
        }
        return response()->json($datas); 
    }

    public function getPackageCategory(){ 
        $data = package_category::where('status',0)->get();
        return response()->json($data); 
    }



    public function saveShipNow(Request $request){
        try{
            $config = [
                'table' => 'shipments',
                'field' => 'order_id',
                'length' => 6,
                'prefix' => '0'
            ];
            $order_id = IdGenerator::generate($config);
    
            $from_address = new manage_address;
            $from_address->user_id = 0;
            $from_address->from_to = 1;
            $from_city = city::where('parent_id',0)->where('city',$request->from_city)->first();
            $from_address->city_id = $from_city->id;
            $from_area = city::where('parent_id',$from_city->id)->where('city',$request->from_area)->first();
            $from_address->area_id = $from_area->id;
            $from_address->country_id = 1;
            $from_address->contact_name = $request->from_name;
            $from_address->contact_mobile = $request->from_mobile;
            $from_address->contact_landline = $request->from_landline;
            $from_address_type=0;
            if($request->from_address_type == 'Home'){
                $from_address_type=1;
            }
            elseif($request->from_address_type == 'Office'){
                $from_address_type=2;
            }
            elseif($request->from_address_type == 'Other'){
                $from_address_type=3;
            }
            $from_address->address_type = $from_address_type;
            $from_address->latitude = $request->from_latitude;
            $from_address->longitude = $request->from_longitude;
            $from_address->address1 = $request->from_address;
            $from_address->save();
    
            $to_address = new manage_address;
            $to_address->user_id = 0;
            $to_address->from_to = 2;
            $to_city = city::where('parent_id',0)->where('city',$request->to_city)->first();
            $to_address->city_id = $to_city->id;
            $to_area = city::where('parent_id',$to_city->id)->where('city',$request->to_area)->first();
            $to_address->area_id = $to_area->id;
            $to_address->country_id = 1;
            $to_address->contact_name = $request->to_name;
            $to_address->contact_mobile = $request->to_mobile;
            $to_address->contact_landline = $request->to_landline;
            $to_address_type=0;
            if($request->to_address_type == 'Home'){
                $to_address_type=1;
            }
            elseif($request->to_address_type == 'Office'){
                $to_address_type=2;
            }
            elseif($request->to_address_type == 'Other'){
                $to_address_type=3;
            }
            $to_address->address_type = $to_address_type;
            $to_address->latitude = $request->to_latitude;
            $to_address->longitude = $request->to_longitude;
            $to_address->address1 = $request->to_address;
            $to_address->save();
            
            $from_station = city::find($from_city->id);
            $to_station = city::find($to_city->id);
    
            $shipment = new shipment;
            $shipment->order_id = $order_id;
            $shipment->date = date('Y-m-d');
            $shipment->sender_id = 0;
            $shipment->shipment_type = 1;
            $shipment->shipment_date = date('Y-m-d',strtotime($request->shipment_date));
            $shipment->shipment_from_time = $request->shipment_from_time;

            $shipment->shipment_to_time = date('H:i A', strtotime($request->shipment_from_time.'+2 hour'));

            $shipment->from_address = $from_address->id;
            $shipment->to_address = $to_address->id;
            $shipment->from_station_id = $from_station->station_id;
            $shipment->to_station_id = $to_station->station_id;
            //$shipment->special_cod_enable = $request->special_cod_enable;
            //$shipment->special_cod = $request->special_cod;
            $shipment->no_of_packages = $request->no_of_packages;
            $shipment->declared_value = $request->declared_value;
            $shipment->total_weight = $request->total_weight;
            $shipment->shipment_price = $request->shipment_price;
            $shipment->postal_charge_percentage = $request->postal_charge_percentage;
            $shipment->postal_charge = $request->postal_charge;
            //$shipment->cod_amount = $request->cod_amount;
            $shipment->sub_total = $request->sub_total;
            $shipment->vat_percentage = $request->vat_percentage;
            $shipment->vat_amount = $request->vat_amount;
            $shipment->insurance_percentage = $request->insurance_percentage;
            $shipment->insurance_amount = $request->insurance_amount;
            //$shipment->before_total = $request->before_total;
            $shipment->total = $request->total;
            $shipment->reference_no = $request->reference_no;
            $shipment->identical = $request->identical;
            $shipment->save();
    
            $guest_user = new guest_user;
            $guest_user->city_id = $from_city->id;
            $guest_user->area_id = $from_area->id;
            $guest_user->country_id = $request->from_country_id;
            $guest_user->name = $request->from_name;
            $guest_user->mobile = $request->from_mobile;
            $guest_user->landline = $request->from_landline;
            $guest_user->latitude = $request->from_latitude;
            $guest_user->longitude = $request->from_longitude;
            $guest_user->address = $request->from_address;
            $guest_user->shipment_id = $shipment->id;
            $guest_user->save();
    
            $system_logs = new system_logs;
            $system_logs->_id = $shipment->id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $request->from_name .'/'. $request->from_mobile;
            $system_logs->remark = 'New Shipment Created by Guest '.$request->from_name;
            $system_logs->save();

            //ship_now_mobile_verify::where('mobile',$request->from_mobile)->delete();
        
            return response()->json(
            ['message' => 'Save Successfully',
            'shipment_id'=>$shipment->id,
            ], 200);
        
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function saveShipNowPackage(Request $request){
        try{
            do {
                $sku_value = mt_rand( 1000000000, 9999999999 );
            } 
            while ( DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists() );

            $shipment_package = new shipment_package;
            $shipment_package->sku_value = $sku_value;
            $shipment_package->shipment_id = $request->shipment_id;
            $category = package_category::where('category',$request->category)->first();
            $shipment_package->category = $category->id;
            $shipment_package->description = $request->description;
            //$shipment_package->reference_no = $request->reference_no;
            $shipment_package->weight = $request->weight;
            $shipment_package->length = $request->length;
            $shipment_package->width = $request->width;
            $shipment_package->height = $request->height;
            $shipment_package->chargeable_weight = $request->chargeable_weight;
            $shipment_package->save();

            $shipment = shipment::find($request->shipment_id);
            $from_address = manage_address::find($shipment->from_address);
            $to_address = manage_address::find($shipment->to_address);

            // $from_msg= "Hi ('.$from_address->contact_name.') your package has been scheduled for delivery from wellwell your tracking ID for this shipment is ('.$shipment_package->sku_value.'). 
            // Please visit our site www.wellwell.ae/track";

            // $to_msg= "Hi ('.$to_address->contact_name.') your package has been scheduled for delivery from wellwell your tracking ID for this shipment is ('.$shipment_package->sku_value.'). 
            // Please visit our site www.wellwell.ae/track";

            //$this->send_sms($from_address->contact_mobile,$from_msg);
            //$this->send_sms($to_address->contact_mobile,$to_msg);
            
            return response()->json(
            ['message' => 'Save Successfully'],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function saveMobileVerify(Request $request){
        try{
            $randomid = mt_rand(1000,9999); 
            // $exist = ship_now_mobile_verify::where('mobile',$request->mobile)->first();
            // if(!empty($exist)){
            //     $ship_now_mobile_verify = ship_now_mobile_verify::where('mobile',$request->mobile)->first();
            //     $ship_now_mobile_verify->otp = $randomid;
            //     $ship_now_mobile_verify->save();
            // }
            // else{
            //     $ship_now_mobile_verify = new ship_now_mobile_verify;
            //     $ship_now_mobile_verify->mobile = $request->mobile;
            //     $ship_now_mobile_verify->otp = $randomid;
            //     $ship_now_mobile_verify->save();
            // }
        
            $msg= "Dear Customer, Please use the code ".$randomid." to verify your Wellwell shipment";

            $this->send_sms($request->from_mobile,$msg);

            return response()->json(
            ['message' => 'Send Successfully' , 'otp' => $randomid],
             200);

        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function verifyOtp($mobile,$otp)
    {
        if($mobile !=null){
            $ship_now_mobile_verify = ship_now_mobile_verify::where('mobile',$mobile)->first();
            if($ship_now_mobile_verify->otp == $otp){
                
                return response()->json(['message' => 'Verified Your Account',
                // 'name'=>$ship_now_mobile_verify->id,
                'status'=>200], 200);
            }else{
                return response()->json('Verification Code Not Valid', 500);
            }
        }else{
            return response()->json('Mobile number Not valid', 400);
        }
    }

    public function getDimension($weight,$length,$width,$height){
        $dimension = ($length * $width * $height) / 5000;
        $chargeable_weight=0;
        if($dimension > $weight){
            $chargeable_weight = $dimension;
        }
        else{
            $chargeable_weight = $weight;
        }  
        return response()->json($chargeable_weight); 
    }

    public function getShippingPrice($weight,$declared_value){
        $common_price = common_price::all();
        $price=0;
        if(!empty($common_price)){
            foreach($common_price as $row){
                if($row->weight_from <= $weight && $row->weight_to >= $weight ){
                    $price = $row->price;
                }
            }
        }
        else{
            $price=0;
        }
        //$data['price'] = $price;
        $insurance_amount = 0;
        $cod_amount = 0;
        $vat_amount = 0;
        $postal_charge = 0;

        $settings = settings::find('1');
        $insurance_amount = ($settings->insurance_percentage/100) * $declared_value;
        
        // if($cod_enable == 1){
        //     $cod_amount = $settings->cod_amount;
        // }

        $sub_total = $price + $insurance_amount + $cod_amount;

        $vat_amount = ($settings->vat_percentage/100) * $sub_total;
    
        if($weight >= 30){
            $postal_charge = 0;
        }
        else{
            $postal_charge = ($settings->postal_charge_percentage/100) * $price;
            if($postal_charge < 2){
                $postal_charge = 2;
            }
        }

        $total = $sub_total + $vat_amount + $postal_charge;

        $data = array(
            'shipment_price' => round($price,2),
            'postal_charge_percentage' => round($settings->postal_charge_percentage,2),
            'postal_charge' => round($postal_charge,2),
            //'cod_amount' => round($cod_amount,2),
            'sub_total' => round($sub_total,2),
            'vat_percentage' => round($settings->vat_percentage,2),
            'vat_amount' => round($vat_amount,2),
            'insurance_percentage' => round($settings->insurance_percentage,2),
            'insurance_amount' => round($insurance_amount,2),
            'total' => round($total,2),
        );

        return response()->json($data); 
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


    public function saveShipment(Request $request){
        try{

            $from_address = manage_address::find($request->from_address);
            $from_station = city::find($from_address->city_id);

            $to_address = manage_address::find($request->to_address);
            $to_station = city::find($to_address->city_id);

            $shipment = new temp_shipment;
            $shipment->date = date('Y-m-d');
            $shipment->sender_id = $request->user_id;
            $shipment->shipment_type = 1;
            $shipment->from_address = $request->from_address;
            $shipment->to_address = $request->to_address;
            $shipment->from_station_id = $from_station->station_id;
            $shipment->to_station_id = $to_station->station_id;
            $shipment->shipment_mode = $request->shipment_mode;
            //$shipment->special_service = $request->special_service;
            //$shipment->special_service_description = $request->special_service_description;
            $shipment->return_package_cost = $request->return_package_cost;
            $shipment->special_cod_enable = $request->special_cod_enable;
            $shipment->special_cod = $request->special_cod;
            $shipment->no_of_packages = $request->no_of_packages;
            $shipment->declared_value = $request->declared_value;
            $shipment->total_weight = $request->total_weight;
            $shipment->shipment_price = $request->shipment_price;
            $shipment->postal_charge_percentage = $request->postal_charge_percentage;
            $shipment->postal_charge = $request->postal_charge;
            $shipment->sub_total = $request->sub_total;
            $shipment->vat_percentage = $request->vat_percentage;
            $shipment->vat_amount = $request->vat_amount;
            $shipment->insurance_percentage = $request->insurance_percentage;
            $shipment->insurance_amount = $request->insurance_amount;
            //$shipment->before_total = $request->before_total;
            $shipment->cod_amount = $request->cod_amount;
            $shipment->total = $request->total;
            $shipment->reference_no = $request->reference_no;
            $shipment->identical = $request->identical;
            $shipment->save();    
        
            return response()->json(
            ['message' => 'Save Successfully',
            'shipment_id'=>$shipment->id,
            ], 200);
        
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function saveShipmentPackage(Request $request){
        try{
            $shipment_package = new temp_shipment_package;
            $shipment_package->temp_id = $request->shipment_id;
            $category = package_category::where('category',$request->category)->first();
            $shipment_package->category = $category->id;
            $shipment_package->description = $request->description;
            //$shipment_package->reference_no = $request->reference_no;
            $shipment_package->weight = $request->weight;
            $shipment_package->length = $request->length;
            $shipment_package->width = $request->width;
            $shipment_package->height = $request->height;
            $shipment_package->chargeable_weight = $request->chargeable_weight;
            $shipment_package->save();

            return response()->json(
            ['message' => 'Save Successfully'],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function getEmail($email){
        try{
            $exist = User::where('email',$email)->get();
            if(count($exist)>0){
                 return response()->json(['message' => 'This Email Address Has been Already Registered','status'=>1], 403);
            }
            else{
                return response()->json(['status'=>0], 200);
            }
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function getMobile($mobile){
        try{
            $exist = User::where('mobile',$mobile)->get();
            if(count($exist)>0){
                 return response()->json(['message' => 'This Email Address Has been Already Registered','status'=>1], 403);
            }
            else{
                return response()->json(['status'=>0], 200);
            }
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function saveRegister(Request $request){
        try{
            //return response()->json($request);
            date_default_timezone_set("Asia/Dubai");
            date_default_timezone_get();

            $config = [
                'table' => 'users',
                'field' => 'customer_id',
                'length' => 6,
                'prefix' => '1'
            ];
            $customer_id = IdGenerator::generate($config);
            
            $user = new User;
            $user->date = date('Y-m-d');
            $user->customer_id = $customer_id;
            $user->user_type = $request->user_type;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->business_name = $request->business_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            //$user->landline = $request->landline;
           // $user->website = $request->website;
            $user->password = Hash::make($request->password);
            
            $user->emirates_id = $request->emirates_id;
            $user->trade_license = $request->trade_license;
            //$user->vat_certificate_no = $request->vat_certificate_no;

            //$user->facebook_url = $request->facebook_url;
            //$user->twitter_url = $request->twitter_url;
            // $user->instagram_url = $request->instagram_url;

            // if($request->file('emirates_id_file')!=""){
            //     $fileName = null;
            //     $image = $request->file('emirates_id_file');
            //     $fileName = rand() . '.' . $image->getClientOriginalExtension();
            //     $image->move(public_path('upload_files/'), $fileName);
            // $user->emirates_id_file = $fileName;
            // }

            if(isset($request->emirates_id_file)){
                if($request->emirates_id_file!=""){
                    $image = $request->emirates_id_file;
                    $image_name = $request->emirates_id_file_name;
                    $filename1='';
                    foreach(explode('.', $image_name) as $info){
                        $filename1 = $info;
                    }
                    $fileName = rand() . '.' . $filename1;
    
                    $realImage = base64_decode($image);
                    file_put_contents(public_path().'/upload_files/'.$fileName, $realImage);    
                    $user->emirates_id_file =  $fileName;
                }
            }

            if($request->user_type == 1){
                if(isset($request->trade_license_file)){
                    if($request->trade_license_file!=""){
                        $image = $request->trade_license_file;
                        $image_name = $request->trade_license_file_name;
                        $filename1='';
                        foreach(explode('.', $image_name) as $info){
                            $filename1 = $info;
                        }
                        $fileName = rand() . '.' . $filename1;
        
                        $realImage = base64_decode($image);
                        file_put_contents(public_path().'/upload_files/'.$fileName, $realImage);    
                        $user->trade_license_file =  $fileName;
                    }
                }
            }
          
            
            $user->signature_data = 'data:image/png;base64,'.$request->signature_data;
            //$user->description = $request->description;
            $user->verify_date_time = date('Y-m-d H:i:s', strtotime('now +24 hour'));
            $user->save();

            // $manage_address = new manage_address;
            // $manage_address->user_id = $user->id;
            // $manage_address->from_to = 1;
            // $manage_address->city_id = $request->city_id;
            // $manage_address->area_id = $request->area_id;
            // $manage_address->country_id = $request->country_id;
            // $manage_address->contact_name = $request->contact_name;
            // $manage_address->contact_mobile = $request->contact_mobile;
            // $manage_address->contact_landline = $request->contact_landline;
            // $manage_address->address_type = $request->address_type;
            // $manage_address->latitude = $request->latitude;
            // $manage_address->longitude = $request->longitude;
            // $manage_address->address1 = $request->address;
            // $manage_address->save();

            $all = User::find($user->id);
            // $all->address_id = $manage_address->id;
            // $all->save();

            Mail::send('mail.verify_mail',compact('all'),function($message) use($all){
                $message->to($all->email)->subject('Well Well Express - Confirm your email');
                $message->from('mail@wellwell.ae','Well Well Express');
            });
        
            return response()->json(
            ['message' => 'Save Successfully'],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        }
    }

    public function getAvailableTime($date){
        //09-03-2021
        try{
            $date1 = date("l" , strtotime($date));
            $value = weeks::where('days',$date1)->first();
            date_default_timezone_set("Asia/Dubai");
            date_default_timezone_get();
            $today = date("l");
            $time = date("h:i A"); 
            $data = array();
            $output ='';
    
            $times = array('12:00 AM','01:00 AM','02:00 AM','03:00 AM','04:00 AM','05:00 AM','06:00 AM','07:00 AM','08:00 AM','09:00 AM','10:00 AM','11:00 AM','12:00 PM','01:00 PM','02:00 PM','03:00 PM','04:00 PM','05:00 PM','06:00 PM','07:00 PM','08:00 PM','09:00 PM','10:00 PM','11:00 PM');
            $data['from_time'] ='';
            foreach($times as $row){
                if($value->status == '1'){
                    if(strtotime($value->open_time) < strtotime($row)){
                        if($today == $value->days){
                            if(strtotime($time) < strtotime($row)){
                                if(strtotime($row) < strtotime($value->close_time)){
                                    $data['from_time'] = $row;
                                    $datas[] = $data;
                                }
                            }
                        }
                        else{
                            if(strtotime($row) < strtotime($value->close_time)){
                                $data['from_time'] = $row;
                                $datas[] = $data;
                            }
                        }
                    }
                }
                else{
                    return response()->json(['message' => $date1.' is Holiday Or Kindly contact our customer service for alternative solution. +971569949409','status'=>400], 400);
                }
                // if($data['from_time'] != ''){
                // $datas[] = $data;
                // }
            }

            if($data['from_time'] == ''){
                return response()->json(['message' => 'Please Choose Other Date Or Kindly contact our customer service for alternative solution. +971569949409','status'=>400], 400);
            }
            $time_data =  array();
            foreach($datas as $d){
                $time_data[] = $d['from_time'];
            }
            return response()->json($time_data);

        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        }
    }

    public function getTerms(){
        $data = settings::select('mobile_terms_english')->first();
        return response()->json($data->mobile_terms_english);
    }

    public function getDashboard($id){
        $total_shipment = shipment::where('sender_id',$id)->count();
        $today = date('Y-m-d');
        $cfdate = date('Y-m-d',strtotime('first day of this month'));
        $cldate = date('Y-m-d',strtotime('last day of this month'));
        $current_month_value = shipment::where('sender_id',$id)->whereBetween('date', [$cfdate, $cldate])->get()->sum("total");
       
        $data = array(
            'current_month_value' => $current_month_value,
            'total_shipment' => $total_shipment,
        );

        return response()->json($data);
    }


    public function getFromAddress($user_id){
        $address = manage_address::where('user_id',$user_id)->where('from_to',1)->get();

        $data =array();
        $datas =array();
        foreach ($address as $key => $value) {
            $data = array(
                'id' => $value->id,
                'address1' => '',
                'address2' => '',
                'address3' => '',
                'latitude' => '',
                'longitude' => '',
                'city' => '',
                'area' => '',
                'name' => $value->contact_name,
                'mobile' => $value->contact_mobile,
            );
            $city = city::find($value->city_id);
            $area = city::find($value->area_id);
            
            if(!empty($value->longitude)){
                $data['longitude'] = $value->longitude;
            }
            if(!empty($value->latitude)){
                $data['latitude'] = $value->latitude;
            }
            if(!empty($value->address1)){
                $data['address1'] = $value->address1;
            }
            if(!empty($value->address2)){
                $data['address2'] = $value->address2;
            }
            if(!empty($value->address3)){
                $data['address3'] = $value->address3;
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

    public function getToAddress($user_id){
        $address = manage_address::where('user_id',$user_id)->where('from_to',2)->get();

        $data =array();
        $datas =array();
        foreach ($address as $key => $value) {
            $data = array(
                'id' => $value->id,
                'address1' => '',
                'address2' => '',
                'address3' => '',
                'latitude' => '',
                'longitude' => '',
                'city' => '',
                'area' => '',
                'name' => $value->contact_name,
                'mobile' => $value->contact_mobile,
            );
            $city = city::find($value->city_id);
            $area = city::find($value->area_id);
            
            if(!empty($value->longitude)){
                $data['longitude'] = $value->longitude;
            }
            if(!empty($value->latitude)){
                $data['latitude'] = $value->latitude;
            }
            if(!empty($value->address1)){
                $data['address1'] = $value->address1;
            }
            if(!empty($value->address2)){
                $data['address2'] = $value->address2;
            }
            if(!empty($value->address3)){
                $data['address3'] = $value->address3;
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


    public function saveAddress(Request $request){
        try{
            $manage_address = new manage_address;
            $manage_address->user_id = $request->user_id;
            $manage_address->from_to = $request->from_to;
            
            $city = city::where('parent_id',0)->where('city',$request->city)->first();
            $manage_address->city_id = $city->id;
            $area = city::where('parent_id',$city->id)->where('city',$request->area)->first();
            $manage_address->area_id = $area->id;

            $manage_address->country_id = 1;
            $manage_address->contact_name = $request->contact_name;
            $manage_address->contact_mobile = $request->contact_mobile;
            $manage_address->contact_landline = $request->contact_landline;
            $address_type=0;
            if($request->address_type == 'Home'){
                $address_type=1;
            }
            elseif($request->address_type == 'Office'){
                $address_type=2;
            }
            elseif($request->address_type == 'Other'){
                $address_type=3;
            }
            $manage_address->address_type = $address_type;
            $manage_address->latitude = $request->latitude;
            $manage_address->longitude = $request->longitude;
            $manage_address->address1 = $request->address1;
            //$manage_address->address2 = $request->address2;
            //$manage_address->address3 = $request->address3;
            $manage_address->save();

            return response()->json(
            ['message' => 'Save Successfully','address_id'=>$manage_address->id],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        }
    }

    public function scheduleShipment(Request $request)
    {
        try{
        // $data = temp_shipment::whereIn('id', $request->id)->get();
        
        // foreach ($data as $row) {
            
        $temp_shipment = temp_shipment::find($request->id);

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
            $shipment->shipment_to_time = date('H:i A', strtotime($request->shipment_from_time.'+2 hour'));
            $shipment->from_address = $temp_shipment->from_address;
            $shipment->to_address = $temp_shipment->to_address;
            $shipment->from_station_id = $from_station->station_id;
            $shipment->to_station_id = $to_station->station_id;
            $shipment->shipment_mode = $temp_shipment->shipment_mode;
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
            //$shipment->before_total = $temp_shipment->before_total;
            $shipment->cod_amount = $temp_shipment->cod_amount;
            $shipment->total = $temp_shipment->total;
            $shipment->reference_no = $temp_shipment->reference_no;
            $shipment->identical = $temp_shipment->identical;
            $shipment->save();

            $user = User::find($temp_shipment->sender_id);
                        
            $system_logs = new system_logs;
            $system_logs->_id = $shipment->id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = $user->email;
            $system_logs->remark = 'New Shipment Created by Customer '.$user->first_name . $user->last_name;
            $system_logs->save();

            $temp_shipment_package = temp_shipment_package::where('temp_id', $temp_shipment->id)->get();
            foreach ($temp_shipment_package as $temp) {
                do {
                    $sku_value = mt_rand( 1000000000, 9999999999);
                } 
                while ( DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists() );

                $shipment_package = new shipment_package;
                $shipment_package->sku_value = $sku_value;
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
            

        $temp_shipment_delete = temp_shipment::find($request->id);
        $temp_shipment_delete->delete();

        temp_shipment_package::where('temp_id', $request->id)->delete();


        //}
            return response()->json(
            ['message' => 'Save Successfully'],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        }
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



    public function pendingShipment($user_id){
        $shipment = temp_shipment::where('sender_id',$user_id)->get();

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
                'to_address1' => '',
                'to_address2' => '',
                'to_address3' => '',
                'to_city' => '',
                'to_area' => '',
                'to_name' => $to_address->contact_name,
                'to_mobile' => $to_address->contact_mobile,
                'status'=>0,
            );
            
            if(!empty($to_address->address1)){
                $data['to_address1'] = $to_address->address1;
            }
            if(!empty($to_address->address2)){
                $data['to_address2'] = $to_address->address2;
            }
            if(!empty($to_address->address3)){
                $data['to_address3'] = $to_address->address3;
            }
            if(!empty($to_city)){
                $data['to_city'] = $to_city->city;
            }
            if(!empty($to_area)){
                $data['to_area'] = $to_area->city;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getDeliveredShipment($user_id){
        $shipment = shipment::where('sender_id',$user_id)->where('status',8)->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_address = manage_address::find($value->from_address);
            $from_city = city::find($from_address->city_id);
            $from_area = city::find($from_address->area_id);
            $to_address = manage_address::find($value->to_address);
            $to_city = city::find($to_address->city_id);
            $to_area = city::find($to_address->area_id);
            $shipment_package = shipment_package::where('shipment_id',$value->id)->get();
            $data = array(
                'id' => $value->id,
                'track_id' => $shipment_package[0]->sku_value,
                'from_address' => '',
                'from_city' => '',
                'from_area' => '',
                'to_address' => '',
                'to_city' => '',
                'to_area' => '',
                'date' => date('d-m-Y',strtotime($value->delivery_date)),
                'time' => date('h:i A',strtotime($value->delivery_time)),
                'status' => 'Shipment Delivered',
                'to_name' => $to_address->contact_name,
                'to_mobile' => $to_address->contact_mobile,
            );
            
            if(!empty($from_address->address1)){
                $data['from_address'] = $from_address->address1;
            }
            if(!empty($from_city)){
                $data['from_city'] = $from_city->city;
            }
            if(!empty($from_area)){
                $data['from_area'] = $from_area->city;
            }
            if(!empty($to_address->address1)){
                $data['to_address'] = $to_address->address1;
            }
            if(!empty($to_city)){
                $data['to_city'] = $to_city->city;
            }
            if(!empty($to_area)){
                $data['to_area'] = $to_area->city;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getAllShipment($user_id){
        $shipment = shipment::where('sender_id',$user_id)->where('status','!=',8)->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_address = manage_address::find($value->from_address);
            $from_city = city::find($from_address->city_id);
            $from_area = city::find($from_address->area_id);
            $to_address = manage_address::find($value->to_address);
            $to_city = city::find($to_address->city_id);
            $to_area = city::find($to_address->area_id);
            $shipment_package = shipment_package::where('shipment_id',$value->id)->get();
            $data = array(
                'id' => $value->id,
                'track_id' => $shipment_package[0]->sku_value,
                'from_address' => '',
                'from_city' => '',
                'from_area' => '',
                'to_address' => '',
                'to_city' => '',
                'to_area' => '',
                'date' => '',
                'time' => '',
                'status' => '',
                'to_name' => $to_address->contact_name,
                'to_mobile' => $to_address->contact_mobile,
                'hold_status' => (int)$value->hold_status,
            );
            
            if(!empty($from_address->address1)){
                $data['from_address'] = $from_address->address1;
            }
            if(!empty($from_city)){
                $data['from_city'] = $from_city->city;
            }
            if(!empty($from_area)){
                $data['from_area'] = $from_area->city;
            }
            if(!empty($to_address->address1)){
                $data['to_address'] = $to_address->address1;
            }
            if(!empty($to_city)){
                $data['to_city'] = $to_city->city;
            }
            if(!empty($to_area)){
                $data['to_area'] = $to_area->city;
            }

            if($value->status == 0){
                $data['status'] = 'Shipment Created';
                $data['date'] = date('d-m-Y',strtotime($value->created_at));
                $data['time'] = date('h:i A',strtotime($value->created_at));
            }
            elseif($value->status == 1){
                $data['status'] = 'Pickup Assigned';
                $data['date'] = date('d-m-Y',strtotime($value->pickup_assign_date));
                $data['time'] = date('h:i A',strtotime($value->pickup_assign_time));
            }
            elseif($value->status == 2){
                $data['status'] = 'Package Collected';
                $data['date'] = date('d-m-Y',strtotime($value->package_collect_date));
                $data['time'] = date('h:i A',strtotime($value->package_collect_time));
            }
            elseif($value->status == 3){
                $data['status'] = 'Pickup Exception';
                $data['date'] = date('d-m-Y',strtotime($value->exception_assign_date));
                $data['time'] = date('h:i A',strtotime($value->exception_assign_time));
            }
            elseif($value->status == 4){
                $data['status'] = 'Transit In';
                $data['date'] = date('d-m-Y',strtotime($value->transit_in_date));
                $data['time'] = date('h:i A',strtotime($value->transit_in_time));
            }
            elseif($value->status == 11){
                $data['status'] = 'Transit In';
                $data['date'] = date('d-m-Y',strtotime($value->transit_in_date));
                $data['time'] = date('h:i A',strtotime($value->transit_in_time));
            }
            elseif($value->status == 6){
                $data['status'] = 'Transit Out';
                $data['date'] = date('d-m-Y',strtotime($value->transit_out_date));
                $data['time'] = date('h:i A',strtotime($value->transit_out_time));
            }
            elseif($value->status == 12){
                $data['status'] = 'Transit Out';
                $data['date'] = date('d-m-Y',strtotime($value->transit_out_date));
                $data['time'] = date('h:i A',strtotime($value->transit_out_time));
            }
            elseif($value->status == 7){
                $data['status'] = 'In the Van to Delivery';
                $data['date'] = date('d-m-Y',strtotime($value->van_scan_date));
                $data['time'] = date('h:i A',strtotime($value->van_scan_time));
            }
            elseif($value->status == 9){
                $data['status'] = 'Delivery Exception';
                $data['date'] = date('d-m-Y',strtotime($value->delivery_exception_assign_date));
                $data['time'] = date('h:i A',strtotime($value->delivery_exception_assign_time));
            }
            elseif($value->status == 10){
                $data['status'] = 'Shipment Canceled';
                $data['date'] = date('d-m-Y',strtotime($value->cancel_request_date));
                $data['time'] = date('h:i A',strtotime($value->cancel_request_time));
            }

            $datas[] = $data;
        }   
        return response()->json($datas); 
    }



    public function getPaymentsInReport($fdate,$tdate,$user_id){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('shipments as s');
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('s.delivery_date', [$fdate1, $tdate1]);
        }
        $i->where('s.sender_id', $user_id);
        $i->where('s.special_cod_enable', 1);
        $i->where('s.status', 8);
        $i->groupBy('s.sender_id');
        $i->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("SUM(s.special_cod) as special_cod") , DB::raw("SUM(s.cod_amount) as admin_fees") , DB::raw("s.sender_id") ]);
        $shipment = $i->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $user = User::find($value->sender_id);
            $data = array(
                'settlement_value' => (String)$user->paid,
                'total_value' => (String)$value->special_cod,
                'no_of_shipments' => (String)$value->no_of_shipments,
                'user_id' => (String)$user->customer_id,
                'user_name' => (String)$user->first_name.' '.$user->last_name,
            );

            $datas[] = $data;
        }   
        return response()->json($datas);
    }

    public function settlementDetails($user_id){
        $user_settlement = user_settlement::where('user_id',$user_id)->get();
        $data =array();
        $datas =array();
        foreach ($user_settlement as $key => $value) {
            $data = array(
                'date' => date("d-m-Y",strtotime($value->date)),
                'paid' => $value->amount,
                'image' => $value->image,
            );

            $datas[] = $data;
        }   
        return response()->json($datas);
    }


    public function getRevenueReport($fdate,$tdate,$user_id){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('shipments');
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('shipments.date', [$fdate1, $tdate1]);
        }
        $i->where('shipments.sender_id',$user_id);
        $i->where('shipments.status',8);
        $i->orderBy('shipments.id','DESC');
        $shipment = $i->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_address = manage_address::find($value->from_address);
            $from_city = city::find($from_address->city_id);
            $from_area = city::find($from_address->area_id);
            $to_address = manage_address::find($value->to_address);
            $to_city = city::find($to_address->city_id);
            $to_area = city::find($to_address->area_id);
            $shipment_package = shipment_package::where('shipment_id',$value->id)->get();
            $data = array(
                'id' => $value->id,
                'track_id' => $shipment_package[0]->sku_value,
                'no_of_packages' => $value->no_of_packages,
                'total_weight' => $value->total_weight,
                'shipment_price' => $value->shipment_price,
                'total' => $value->total,
                'postal_charge_percentage' => '',
                'postal_charge' => '',
                'vat_percentage' => '',
                'vat_amount' => '',
                'insurance_percentage' => '',
                'insurance_amount' => '',
                'cod_amount' => '',
            );
            
            if(!empty($value->cod_amount)){
                $data['cod_amount'] = $value->cod_amount;
            }
            if(!empty($value->postal_charge)){
                $data['postal_charge'] = $value->postal_charge;
                $data['postal_charge_percentage'] = $value->postal_charge_percentage;
            }
            if(!empty($value->insurance_amount)){
                $data['insurance_amount'] = $value->insurance_amount;
                $data['insurance_percentage'] = $value->insurance_percentage;
            }
            if(!empty($value->vat_amount)){
                $data['vat_amount'] = $value->vat_amount;
                $data['vat_percentage'] = $value->vat_percentage;
            }
        
            $datas[] = $data;
        }   
        return response()->json($datas);
    }


    public function getShipmentReport($status,$fdate,$tdate,$user_id){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('shipments');

        if ( $status != 20 )
        {
            if ( $status == 4 ){
                $i->where('shipments.status', 4);
                $i->orWhere('shipments.status', 11);
            }
            elseif ( $status == 6 ){
                $i->where('shipments.status', 6);
                $i->orWhere('shipments.status', 12);
            }
            else{
                $i->where('shipments.status', $status);
            }
        }
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('shipments.date', [$fdate1, $tdate1]);
        }
        $i->where('shipments.sender_id',$user_id);
        $i->orderBy('shipments.id','DESC');
        $shipment = $i->get();
        
        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_address = manage_address::find($value->from_address);
            $from_city = city::find($from_address->city_id);
            $from_area = city::find($from_address->area_id);
            $to_address = manage_address::find($value->to_address);
            $to_city = city::find($to_address->city_id);
            $to_area = city::find($to_address->area_id);
            $shipment_package = shipment_package::where('shipment_id',$value->id)->get();
            $data = array(
                'id' => $value->id,
                'track_id' => $shipment_package[0]->sku_value,
                'from_address' => '',
                'from_city' => '',
                'from_area' => '',
                'to_address' => '',
                'to_city' => '',
                'to_area' => '',
                'date' => '',
                'time' => '',
                'service_type' => '',
                'total' => $value->total,
                'status' => '',
                'to_name' => $to_address->contact_name,
                'to_mobile' => $to_address->contact_mobile,
            );

            if($value->shipment_mode == 1){
                $data['service_type'] = 'Standard';
            }
            else{
                $data['service_type'] = 'Express';
            }
            
            if(!empty($from_address->address1)){
                $data['from_address'] = $from_address->address1;
            }
            if(!empty($from_city)){
                $data['from_city'] = $from_city->city;
            }
            if(!empty($from_area)){
                $data['from_area'] = $from_area->city;
            }
            if(!empty($to_address->address1)){
                $data['to_address'] = $to_address->address1;
            }
            if(!empty($to_city)){
                $data['to_city'] = $to_city->city;
            }
            if(!empty($to_area)){
                $data['to_area'] = $to_area->city;
            }

            if($value->status == 0){
                $data['status'] = 'Shipment Created';
                $data['date'] = date('d-m-Y',strtotime($value->created_at));
                $data['time'] = date('h:i A',strtotime($value->created_at));
            }
            elseif($value->status == 1){
                $data['status'] = 'Pickup Assigned';
                $data['date'] = date('d-m-Y',strtotime($value->pickup_assign_date));
                $data['time'] = date('h:i A',strtotime($value->pickup_assign_time));
            }
            elseif($value->status == 2){
                $data['status'] = 'Package Collected';
                $data['date'] = date('d-m-Y',strtotime($value->package_collect_date));
                $data['time'] = date('h:i A',strtotime($value->package_collect_time));
            }
            elseif($value->status == 3){
                $data['status'] = 'Pickup Exception';
                $data['date'] = date('d-m-Y',strtotime($value->exception_assign_date));
                $data['time'] = date('h:i A',strtotime($value->exception_assign_time));
            }
            elseif($value->status == 4){
                $data['status'] = 'Transit In';
                $data['date'] = date('d-m-Y',strtotime($value->transit_in_date));
                $data['time'] = date('h:i A',strtotime($value->transit_in_time));
            }
            elseif($value->status == 11){
                $data['status'] = 'Transit In';
                $data['date'] = date('d-m-Y',strtotime($value->transit_in_date));
                $data['time'] = date('h:i A',strtotime($value->transit_in_time));
            }
            elseif($value->status == 6){
                $data['status'] = 'Transit Out';
                $data['date'] = date('d-m-Y',strtotime($value->transit_out_date));
                $data['time'] = date('h:i A',strtotime($value->transit_out_time));
            }
            elseif($value->status == 12){
                $data['status'] = 'Transit Out';
                $data['date'] = date('d-m-Y',strtotime($value->transit_out_date));
                $data['time'] = date('h:i A',strtotime($value->transit_out_time));
            }
            elseif($value->status == 7){
                $data['status'] = 'In the Van to Delivery';
                $data['date'] = date('d-m-Y',strtotime($value->van_scan_date));
                $data['time'] = date('h:i A',strtotime($value->van_scan_time));
            }
            elseif($value->status == 9){
                $data['status'] = 'Delivery Exception';
                $data['date'] = date('d-m-Y',strtotime($value->delivery_exception_assign_date));
                $data['time'] = date('h:i A',strtotime($value->delivery_exception_assign_time));
            }
            elseif($value->status == 10){
                $data['status'] = 'Shipment Canceled';
                $data['date'] = date('d-m-Y',strtotime($value->cancel_request_date));
                $data['time'] = date('h:i A',strtotime($value->cancel_request_time));
            }

            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getInvoice($fdate,$tdate,$user_id){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('invoices as i');
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('i.date', [$fdate1, $tdate1]);
        }
        $i->where('i.sender_id',$user_id);
        $invoice = $i->get();

        $data =array();
        $datas =array();
        foreach ($invoice as $key => $value) {
            $user = User::find($value->sender_id);
            $data = array(
                'invoice_date' => $value->date,
                'customer_id' => $value->account_id,
                'name' => $value->name,
                'no_of_shipments' => $value->no_of_shipments,
                'no_of_packages' => $value->no_of_packages,
                'total' => $value->total,
            );

            $datas[] = $data;
        }   
        return response()->json($datas);
    }

    public function HoldShipment($id,$status){
        $shipment = shipment::find($id);
        $shipment->hold_status = $status;
        $shipment->save();

        $user = User::find($shipment->sender_id);
        
        $system_logs = new system_logs;
        $system_logs->_id = $shipment->id;
        $system_logs->category = 'shipment';
        $system_logs->to_id = $user->email;
        if($status == 0){
            $system_logs->remark = 'Active Hold Shipment by Customer';
        }
        else{
            $system_logs->remark = 'Cancel Hold Shipment by Customer';
        }
        $system_logs->save();

        return response()->json(
            ['message' => 'Shipment Hold Successfully'],
             200);
    }


    public function CancelShipment(Request $request){
        $shipment = shipment::find($request->shipment_id);
        $shipment->cancel_remark = $request->cancel_remark;
        $shipment->cancel_request_date = date('Y-m-d');
        $shipment->cancel_request_time = date('H:i:s');
        if($shipment->status >= 2){
            $shipment->cancel_pay = 1;
        }
        $shipment->status = 10;
        $shipment->save();

        $system_logs = new system_logs;
        $system_logs->_id = $shipment->id;
        $system_logs->category = 'shipment';
        $system_logs->to_id = Auth::user()->email;
        $system_logs->remark = 'Cancel Shipment Created by Customer';
        $system_logs->save();

        return response()->json(
            ['message' => 'Shipment Hold Successfully'],
             200);
    }


    public function excelShipmentReport($status,$fdate,$tdate,$user_id){
        $fdate = date('Y-m-d', strtotime($fdate));
        $tdate = date('Y-m-d', strtotime($tdate));
        
        return Excel::download(new UserShipmentExport($status,$fdate,$tdate,$user_id), 'shipmentreport.xlsx');
    }

    public function excelRevenueReport($fdate,$tdate,$user_id){
        $fdate = date('Y-m-d', strtotime($fdate));
        $tdate = date('Y-m-d', strtotime($tdate));
        
        return Excel::download(new UserRevenueExport($fdate,$tdate,$user_id), 'revenuereport.xlsx');
    }

    public function ShipmentSendSMS($id){
        $shipment = shipment::find($id);
        $shipment_package = shipment_package::where('shipment_id',$id)->first();
        $from_address = manage_address::find($shipment->from_address);
        $to_address = manage_address::find($shipment->to_address);

        $from_msg= "Hi ('.$from_address->contact_name.') your package has been scheduled for delivery from wellwell your tracking ID for this shipment is ('.$shipment_package->sku_value.'). 
        Please visit our site www.wellwell.ae/track";

        $to_msg= "Hi ('.$to_address->contact_name.') your package has been scheduled for delivery from wellwell your tracking ID for this shipment is ('.$shipment_package->sku_value.'). 
        Please visit our site www.wellwell.ae/track";

        $this->send_sms($from_address->contact_mobile,$from_msg);
        $this->send_sms($to_address->contact_mobile,$to_msg);

        return response()->json(
            ['message' => 'SMS Send Successfully'],
             200);
    }

}
