<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\country;
use App\Models\city;
use App\Models\manage_address;
use App\Models\drop_point;
use App\Models\shipment_category;
use App\Models\package_category;
use App\Models\agent;
use App\Models\shipment;
use App\Models\shipment_package;
use App\Models\shipment_notification;
use App\Models\add_rate;
use App\Models\add_rate_item;
use App\Models\common_price;
use App\Models\settings;
use App\Models\ship_now_mobile_verify;
use Mail;
use Hash;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use PDF;

class PageController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

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

    public function getArea($id){ 
    
        $data = city::where('parent_id',$id)->orderBy('city','ASC')->get();
    
            $output ='<option value="">SELECT Area</option>';
            foreach ($data as $key => $value) {
                
            $output .= '<option value="'.$value->id.'">'.$value->city.'</option>';
            }
        echo $output;
    }

    public function Home()
    {
        return view('page.home');
    }

    public function HomeArabic()
    {
        return view('page.home_ae');
    }

    public function Track($id)
    {
        $check1 = shipment_package::where('barcode_package',$id)->first();
        $check2 = shipment::where('order_id',$id)->first();
        $shipment_id='';
        if(!empty($check1)){
            $shipment_id = $check1->shipment_id;
        }
        elseif(!empty($check2)){
            $shipment_id = $check2->id;
        }


        $country = country::all();
        $agent = agent::all();
        $package_category = package_category::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();

        $shipment =shipment::find($shipment_id);
        if(!empty($shipment)){
        $user =User::find($shipment->sender_id);
        $shipment_package = shipment_package::where('shipment_id',$shipment_id)->get();

        $from_address =manage_address::find($shipment->from_address);
        $to_address =manage_address::find($shipment->to_address);
        return view('page.track',compact('package_category','city','area','shipment','user','shipment_package','from_address','to_address','id'));
        }
        else{
            return view('page.track',compact('shipment','id'));
        }
    }

    public function userRegister()
    {
        $country = country::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        return view('page.user_register',compact('country','city','area'));
    }


    public function saveUserRegister(Request $request){

        $this->validate($request, [
            'mobile'=> 'required|unique:users',
            'email'=> 'required|unique:users',
            'first_name'=>'required',
            'last_name'=>'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'emirates_id_file' => 'mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
            'trade_license_file' => 'mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
            'vat_certificate_file' => 'mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
            'profile_image' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'profile_image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'profile_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'vat_certificate_file.mimes' => 'Only jpeg, png and jpg images are allowed',
            'vat_certificate_file.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'passport_file.mimes' => 'Only jpeg, png and jpg images are allowed',
            'passport_file.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'emirates_id_file.mimes' => 'Only jpeg, png and jpg images are allowed',
            'emirates_id_file.max' => 'Sorry! Maximum allowed size for an image is 1MB',
        ]);

        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        
        
        $user = new User;
        $user->date = date('Y-m-d');
        $user->user_type = $request->user_type;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->business_name = $request->business_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->landline = $request->landline;
        $user->website = $request->website;
        $user->password = Hash::make($request->password);
        
        $user->emirates_id = $request->emirates_id;
        $user->trade_license = $request->trade_license;
        $user->vat_certificate_no = $request->vat_certificate_no;

        $user->facebook_url = $request->facebook_url;
        $user->twitter_url = $request->twitter_url;
        $user->instagram_url = $request->instagram_url;

        

        if($request->file('emirates_id_file')!=""){
            $fileName = null;
            $image = $request->file('emirates_id_file');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $user->emirates_id_file = $fileName;
        }
        if($request->file('trade_license_file')!=""){
            $fileName = null;
            $image = $request->file('trade_license_file');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $user->trade_license_file = $fileName;
        }
        if($request->file('vat_certificate_file')!=""){
            $fileName = null;
            $image = $request->file('vat_certificate_file');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $user->vat_certificate_file = $fileName;
        }
        if($request->file('profile_image')!=""){
            $fileName = null;
            $image = $request->file('profile_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $user->profile_image = $fileName;
        }
        
        $user->signature_data = $request->signature_data;
        $user->description = $request->description;
        $user->verify_date_time = date('Y-m-d H:i:s', strtotime('now +24 hour'));
        $user->save();

        $manage_address = new manage_address;
        $manage_address->user_id = $user->id;
        $manage_address->from_to = 1;
        $manage_address->city_id = $request->city_id;
        $manage_address->area_id = $request->area_id;
        $manage_address->country_id = $request->country_id;
        $manage_address->contact_name = $request->contact_name;
        $manage_address->contact_mobile = $request->contact_mobile;
        $manage_address->contact_landline = $request->contact_landline;
        $manage_address->address_type = $request->address_type;
        $manage_address->latitude = $request->latitude;
        $manage_address->longitude = $request->longitude;
        $manage_address->address1 = $request->address;
        $manage_address->save();

        $all = User::find($user->id);
        $all->address_id = $manage_address->id;
        $all->save();

        Mail::send('mail.verify_mail',compact('all'),function($message) use($all){
            $message->to($all->email)->subject('Well Well Express - Confirm your email');
            $message->from('info@lrbinfotech.com','Well Well Express');
        });
        
        return response()->json('Save Successfully'); 
    }

    public function verifyAccount($id){
        $user = User::find($id);

        if(strtotime($user->verify_date_time) >= strtotime(date('Y-m-d H:i:s'))){
            $user->status = 1;
            $user->save();
        }
        return view('auth.verify_login',compact('user'));
    }

    public function sendMail($id){
        $all = User::find($id);
        Mail::send('mail.verify_mail',compact('all'),function($message) use($all){
            $message->to($all->email)->subject('Well Well Express - Confirm your email');
            $message->from('info@lrbinfotech.com','Well Well Express');
        });
    }

    public function shipNow()
    {
        $country = country::all();
        $settings = settings::find(1);
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $package_category = package_category::all();
        return view('page.ship_now',compact('country','city','area','package_category','settings'));
    }


    public function getAreaPrice($weight){
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
        $data['price'] = $price;
        return response()->json($data); 
    }

    public function saveMobileVerify(Request $request){
        $randomid = mt_rand(1000,9999); 
        $exist = ship_now_mobile_verify::where('mobile',$request->from_mobile)->first();
        if(!empty($exist)){
            $ship_now_mobile_verify = ship_now_mobile_verify::where('mobile',$request->from_mobile)->first();
            $ship_now_mobile_verify->otp = $randomid;
            $ship_now_mobile_verify->save();
        }
        else{
            $ship_now_mobile_verify = new ship_now_mobile_verify;
            $ship_now_mobile_verify->mobile = $request->from_mobile;
            $ship_now_mobile_verify->otp = $randomid;
            $ship_now_mobile_verify->save();
        }
    
        $msg= "Dear Customer, Please use the code ".$ship_now_mobile_verify->otp." to verify your Wellwell shipment";

        $this->send_sms($ship_now_mobile_verify->mobile,$msg);

        return response()->json('Save Successfully'); 
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



    public function saveNewShipment(Request $request){

        $config = [
            'table' => 'shipments',
            'field' => 'order_id',
            'length' => 6,
            'prefix' => '0'
        ];
        $order_id = IdGenerator::generate($config);

        do {
            $barcode_shipment = mt_rand( 1000000000, 9999999999 );
        } 
        while ( DB::table( 'shipments' )->where( 'barcode_shipment', $barcode_shipment )->exists() );

        
        $from_address = new manage_address;
        $from_address->user_id = 0;
        $from_address->from_to = 1;
        $from_address->city_id = $request->from_city_id;
        $from_address->area_id = $request->from_area_id;
        $from_address->country_id = $request->from_country_id;
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
        $to_address->country_id = $request->to_country_id;
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
        $shipment->barcode_shipment = $barcode_shipment;
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
        $shipment->before_total = $request->before_total;
        $shipment->total = $request->total;
        $shipment->save();

        if($request->same_data == '0'){
            for ($x=0; $x<count($_POST['weight']); $x++) 
            {
                do {
                    $barcode_package = mt_rand( 1000000000, 9999999999 );
                } 
                while ( DB::table( 'shipment_packages' )->where( 'barcode_package', $barcode_package )->exists() );
                $shipment_package = new shipment_package;
                $shipment_package->barcode_package = $barcode_package;
                $shipment_package->shipment_id = $shipment->id;
                $shipment_package->category = $_POST['category'][$x];
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
                        $barcode_package = mt_rand( 1000000000, 9999999999 );
                    } 
                    while ( DB::table( 'shipment_packages' )->where( 'barcode_package', $barcode_package )->exists() );
                    $shipment_package = new shipment_package;
                    $shipment_package->barcode_package = $barcode_package;
                    $shipment_package->shipment_id = $shipment->id;
                    $shipment_package->category = $_POST['category'][$x];
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
        
        ship_now_mobile_verify::where('mobile',$request->from_mobile)->delete();
        return response()->json('successfully save'); 
        //return $this->printLabel($shipment->id);
    }


}
