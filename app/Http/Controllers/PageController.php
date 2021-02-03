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
use Mail;
use Hash;

class PageController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function getArea($id){ 
    
        $data = city::where('parent_id',$id)->get();
    
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
}
