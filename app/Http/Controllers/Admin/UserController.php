<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\role;
use App\Models\language;
use App\Models\station;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function saveUser(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'role_id'=> 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'profile_image' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'profile_image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'profile_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'image.required' => 'Item Image Field is Required',
        ]);

        $admin = new admin;
        $admin->employee_id = $request->employee_id;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->dob = $request->dob;
        $admin->gender = $request->gender;
        $admin->role_id = $request->role_id;
        $admin->station_id = $request->station_id;
        $admin->password = Hash::make($request->password);
        if($request->profile_image!=""){
            if($request->file('profile_image')!=""){
            $image = $request->file('profile_image');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $admin->profile_image = $upload_image;
            }
        }

        $admin->language = $request->language;
        $admin->common_price = $request->common_price;
        $admin->financial_settings = $request->financial_settings;
        $admin->station = $request->station;
        $admin->exception_category = $request->exception_category;
        $admin->package_category = $request->package_category;
        $admin->country = $request->country;
        $admin->user_report = $request->user_report;
        $admin->agent_report = $request->agent_report;
        $admin->revenue_report = $request->revenue_report;
        $admin->shipment_report = $request->shipment_report;
        $admin->employee = $request->employee;
        $admin->agent = $request->agent;
        $admin->all_shipment = $request->all_shipment;
        $admin->cancel_request = $request->cancel_request;
        $admin->shipment_delivered = $request->shipment_delivered;
        $admin->delivery_exception = $request->delivery_exception;
        $admin->ready_for_delivery = $request->ready_for_delivery;
        $admin->transit_out = $request->transit_out;
        $admin->transit_in = $request->transit_in;
        $admin->package_collected = $request->package_collected;
        $admin->pickup_exception = $request->pickup_exception;
        $admin->schedule_for_pickup = $request->schedule_for_pickup;
        $admin->new_shipment_request = $request->new_shipment_request;
        $admin->new_shipment = $request->new_shipment;
        $admin->view_customer = $request->view_customer;
        //$admin->dashboard = $request->dashboard;

        $admin->save();
        return response()->json('successfully save'); 
    }
    public function updateUser(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'role_id'=> 'required',
            //'password' => 'min:6|same:password_confirmation',
            //'password_confirmation' => 'min:6',
            'profile_image' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'profile_image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'profile_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            //'image.required' => 'Item Image Field is Required',
        ]);
        $admin = admin::find($request->id);
        $admin->employee_id = $request->employee_id;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->role_id = $request->role_id;
        $admin->station_id = $request->station_id;
        $admin->dob = $request->dob;
        $admin->gender = $request->gender;
        if($request->password != ''){
        $admin->password = Hash::make($request->password);
        }
        if($request->profile_image!=""){
            $old_image = "upload_files/".$admin->profile_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            if($request->file('profile_image')!=""){
            $image = $request->file('profile_image');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $admin->profile_image = $upload_image;
            }
        }

        $admin->language = $request->language;
        $admin->common_price = $request->common_price;
        $admin->financial_settings = $request->financial_settings;
        $admin->station = $request->station;
        $admin->exception_category = $request->exception_category;
        $admin->package_category = $request->package_category;
        $admin->country = $request->country;
        $admin->user_report = $request->user_report;
        $admin->agent_report = $request->agent_report;
        $admin->revenue_report = $request->revenue_report;
        $admin->shipment_report = $request->shipment_report;
        $admin->employee = $request->employee;
        $admin->agent = $request->agent;
        $admin->all_shipment = $request->all_shipment;
        $admin->cancel_request = $request->cancel_request;
        $admin->shipment_delivered = $request->shipment_delivered;
        $admin->delivery_exception = $request->delivery_exception;
        $admin->ready_for_delivery = $request->ready_for_delivery;
        $admin->transit_out = $request->transit_out;
        $admin->transit_in = $request->transit_in;
        $admin->package_collected = $request->package_collected;
        $admin->pickup_exception = $request->pickup_exception;
        $admin->schedule_for_pickup = $request->schedule_for_pickup;
        $admin->new_shipment_request = $request->new_shipment_request;
        $admin->new_shipment = $request->new_shipment;
        $admin->view_customer = $request->view_customer;
        //$admin->dashboard = $request->dashboard;

        $admin->save();
        return response()->json('successfully update'); 
    }

    public function User(){
        $user = admin::all();
        $role = role::all();
        $station = station::all();
        $language = language::all();
        return view('admin.user',compact('user','role','station','language'));
    }

    public function editUser($id){
        $user = admin::find($id);
        return response()->json($user); 
    }
    
    public function deleteUser($id){
        $user = admin::find($id);
            $old_image = "upload_files/".$user->profile_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
        $user->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function saveRole(Request $request){
        $request->validate([
            'role_name'=>'required',
        ]);

        $role = new role;
        $role->role_name = $request->role_name;
        $role->save();
        return response()->json('successfully save'); 
    }
    public function updateRole(Request $request){
        $request->validate([
            'role_name'=> 'required',
        ]);

        $role = role::find($request->id);
        $role->role_name = $request->role_name;
        $role->save();
        return response()->json('successfully update'); 
    }

    public function Role(){
        $role = role::all();
        $language = language::all();
        return view('admin.role',compact('role','language'));
    }

    public function editRole($id){
        $user = role::find($id);
        return response()->json($user); 
    }
    
    public function deleteRole($id){
        $user = role::find($id);
        $user->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

}
