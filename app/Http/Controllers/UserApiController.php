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

class UserApiController extends Controller
{
    private function send_sms($phone,$msg)
    {
      $requestParams = array(
        //'Unicode' => '0',
        //'route_id' => '2',
        'datetime' => '2020-09-27',
        'username' => 'isalonuae',
        'password' => 'Ms5sbqBxif',
        'senderid' => 'ISalon UAE',
        'type' => 'text',
        'to' => '+971'.$phone,
        'text' => $msg
      );
      
      //merge API url and parameters
      $apiUrl = 'https://smartsmsgateway.com/api/api_http.php?';
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
        $exist = User::where('email',$request->email)->where('status',0)->get();
        if(count($exist)>0){
            if($exist[0]->status == 4){
                if(Hash::check($request->password,$exist[0]->password)){
                    $user = User::find($exist[0]->id);
                    $user->firebase_key = $request->firebase_key;
                    $user->save();

                return response()->json(['message' => 'Login Successfully',
                'user_id'=>$exist[0]->id,'status'=>200], 200);
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
                    'status'=>$check1[0]->status,
                    'mode'=>'',
                    );
                if($check1[0]->shipment_mode == 1){
                    $data['mode'] = 'standard';
                }
                else{
                    $data['mode'] = 'express';
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
        return response()->json($data); 
    }

    public function getArea($id){ 
        $data = city::where('parent_id',$id)->where('status',0)->orderBy('city','ASC')->get();
        return response()->json($data); 
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
            $from_address->city_id = $request->from_city_id;
            $from_address->area_id = $request->from_area_id;
            $from_address->country_id = 1;
            $from_address->contact_name = $request->from_name;
            $from_address->contact_mobile = $request->from_mobile;
            $from_address->contact_landline = $request->from_landline;
            $from_address->address_type = $request->from_address_type;
            $from_address->latitude = $request->from_latitude;
            $from_address->longitude = $request->from_longitude;
            $from_address->address1 = $request->from_address;
            $from_address->save();
    
            $to_address = new manage_address;
            $to_address->user_id = 0;
            $to_address->from_to = 2;
            $to_address->city_id = $request->to_city_id;
            $to_address->area_id = $request->to_area_id;
            $to_address->country_id = 1;
            $to_address->contact_name = $request->to_name;
            $to_address->contact_mobile = $request->to_mobile;
            $to_address->contact_landline = $request->to_landline;
            $to_address->address_type = $request->to_address_type;
            $to_address->latitude = $request->to_latitude;
            $to_address->longitude = $request->to_longitude;
            $to_address->address1 = $request->to_address;
            $to_address->save();
            
            $from_station = city::find($request->from_city_id);
            $to_station = city::find($request->to_city_id);
    
            $shipment = new shipment;
            $shipment->order_id = $order_id;
            $shipment->date = date('Y-m-d');
            $shipment->sender_id = 0;
            $shipment->shipment_type = 1;
            $shipment->shipment_date = date('Y-m-d',strtotime($request->shipment_date));
            $shipment->shipment_from_time = $request->shipment_from_time;
            $shipment->shipment_to_time = $request->shipment_to_time;
            $shipment->from_address = $from_address->id;
            $shipment->to_address = $to_address->id;
            $shipment->from_station_id = $from_station->station_id;
            $shipment->to_station_id = $to_station->station_id;
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
            $shipment->total = $request->total;
            $shipment->reference_no = $request->reference_no;
            $shipment->save();
    
            $guest_user = new guest_user;
            $guest_user->city_id = $request->from_city_id;
            $guest_user->area_id = $request->from_area_id;
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
            $shipment_package->category = $request->category;
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
            $exist = ship_now_mobile_verify::where('mobile',$request->mobile)->first();
            if(!empty($exist)){
                $ship_now_mobile_verify = ship_now_mobile_verify::where('mobile',$request->mobile)->first();
                $ship_now_mobile_verify->otp = $randomid;
                $ship_now_mobile_verify->save();
            }
            else{
                $ship_now_mobile_verify = new ship_now_mobile_verify;
                $ship_now_mobile_verify->mobile = $request->mobile;
                $ship_now_mobile_verify->otp = $randomid;
                $ship_now_mobile_verify->save();
            }
        
            $msg= "Dear Customer, Please use the code ".$ship_now_mobile_verify->otp." to verify your Wellwell shipment";

            $this->send_sms($ship_now_mobile_verify->mobile,$msg);

            return response()->json(
            ['message' => 'Save Successfully'],
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

    public function getShippingPrice($weight,$declared_value,$cod_enable){
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
        
        if($cod_enable == 1){
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

        $data = array(
            'postal_charge_percentage' => $settings->postal_charge_percentage,
            'postal_charge' => $postal_charge,
            'cod_amount' => $cod_amount,
            'sub_total' => $sub_total,
            'vat_percentage' => $settings->vat_percentage,
            'vat_amount' => $vat_amount,
            'insurance_percentage' => $settings->insurance_percentage,
            'insurance_amount' => $insurance_amount,
            'total' => $total,
        );

        return response()->json($data); 
    }

}
