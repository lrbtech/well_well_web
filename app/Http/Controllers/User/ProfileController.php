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
use App\Models\admin;
use App\Models\language;
use App\Models\add_rate;
use App\Models\add_rate_item;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function changelanguage($language)
    {
        $user = User::find(Auth::user()->id);
        $user->lang = $language;
        $user->save();
        return response()->json(['message'=>'Successfully Update'],200); 
    }

    public function editProfile(){
        $customer = User::find(Auth::user()->id);
        $admin = admin::find($customer->accounts_user_id);
        $language = language::all();
        return view('user.edit_profile',compact('customer','language','admin'));
    }

    public function updateProfile(Request $request){        
    
        $user = User::find($request->id);
        //$user->user_type = $request->user_type;
        //$user->first_name = $request->first_name;
        //$user->last_name = $request->last_name;
        $user->business_name = $request->business_name;
        //$user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->landline = $request->landline;
        $user->website = $request->website;
        
        $user->emirates_id = $request->emirates_id;
        $user->trade_license = $request->trade_license;
        $user->vat_certificate_no = $request->vat_certificate_no;

        // $user->facebook_url = $request->facebook_url;
        // $user->twitter_url = $request->twitter_url;
        // $user->instagram_url = $request->instagram_url;

        if($request->file('profile_image')!=""){
            $old_image = "upload_files/".$user->profile_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('profile_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $user->profile_image = $fileName;
        }
        
        $user->description = $request->description;
        $user->save();


        //return response()->json($request);
        return response()->json('successfully save'); 
    }

    public function changePassword()
    {
        $user = User::find(Auth::user()->id);
        return view('user.change_password',compact('user'));
    }

    public function updateChangePassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        
        $hashedPassword = Auth::user()->password;
 
        if (\Hash::check($request->oldpassword , $hashedPassword )) {
 
            if (!\Hash::check($request->password , $hashedPassword)) {
 
                $customer = User::find($request->id);
                $customer->password = Hash::make($request->password);
                $customer->save();
 
                return response()->json(['message' => 'Password Updated Successfully!' , 'status' => 1], 200);
            }
 
            else{
                return response()->json(['message' => 'new password can not be the old password!' , 'status' => 0]);
            }
 
           }
 
        else{
            return response()->json(['message' => 'old password doesnt matched!' , 'status' => 0]);
        }
    }

}
