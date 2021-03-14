<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\role;
use App\Models\language;
use App\Models\station;
use Hash;
use Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Admin\logController;

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

        $config = [
            'table' => 'admins',
            'field' => 'employee_id',
            'length' => 4,
            'prefix' => '1'
        ];

        $employee_id = IdGenerator::generate($config);

        $admin = new admin;
        $admin->employee_id = $employee_id;
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

        $admin->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create New Employee '.$admin->employee_id.'");

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

        $admin->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Employee '.$admin->employee_id.'");

        return response()->json('successfully update'); 
    }

    public function User(){
        $user = admin::all();
        $role = role::where('status',0)->get();
        $station = station::all();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.view_users',compact('user','role','station','language','role_get'));
    }

    public function editUser($id){
        $user = admin::find($id);
        return response()->json($user); 
    }
    
    public function deleteUser($id){
        $user = admin::find($id);
            // $old_image = "upload_files/".$user->profile_image;
            // if (file_exists($old_image)) {
            //     @unlink($old_image);
            // }
        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Employee '.$user->employee_id.'");

        $user->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function saveRole(Request $request){
        $request->validate([
            'role_name'=>'required',
        ]);

        $role = new role;
        $role->role_name = $request->role_name;
        $role->dashboard = $request->dashboard;
        $role->all_customer = $request->all_customer;
        $role->all_customer_edit = $request->all_customer_edit;
        $role->all_customer_delete = $request->all_customer_delete;
        $role->new_customer = $request->new_customer;
        $role->new_customer_edit = $request->new_customer_edit;
        $role->new_customer_delete = $request->new_customer_delete;
        $role->sales_team = $request->sales_team;
        $role->sales_team_edit = $request->sales_team_edit;
        $role->sales_team_delete = $request->sales_team_delete;
        $role->accounts_team = $request->accounts_team;
        $role->accounts_team_edit = $request->accounts_team_edit;
        $role->accounts_team_delete = $request->accounts_team_delete;
        $role->create_shipment = $request->create_shipment;
        $role->create_special_shipment = $request->create_special_shipment;
        $role->all_shipment = $request->all_shipment;
        $role->revenue_exception = $request->revenue_exception;
        $role->cancel_shipment = $request->cancel_shipment;
        $role->shipment_hold = $request->shipment_hold;
        $role->new_pickup_request = $request->new_pickup_request;
        $role->new_pickup_request_edit = $request->new_pickup_request_edit;
        $role->guest_pickup_request = $request->guest_pickup_request;
        $role->guest_pickup_request_edit = $request->guest_pickup_request_edit;
        $role->today_bulk_pickup_request = $request->today_bulk_pickup_request;
        $role->today_bulk_pickup_request_edit = $request->today_bulk_pickup_request_edit;
        $role->future_bulk_pickup_request = $request->future_bulk_pickup_request;
        $role->future_bulk_pickup_request_edit = $request->future_bulk_pickup_request_edit;
        $role->pickup_assigned = $request->pickup_assigned;
        $role->pickup_exception = $request->pickup_exception;
        $role->pickup_exception_edit = $request->pickup_exception_edit;
        $role->package_collected = $request->package_collected;
        $role->transit_in = $request->transit_in;
        $role->transit_out = $request->transit_out;
        $role->package_at_station = $request->package_at_station;
        $role->van_for_delivery = $request->van_for_delivery;
        $role->delivery_exception = $request->delivery_exception;
        $role->shipment_delivered = $request->shipment_delivered;
        $role->today_delivery = $request->today_delivery;
        $role->future_delivery = $request->future_delivery;
        $role->couriers = $request->couriers;
        $role->couriers_create = $request->couriers_create;
        $role->couriers_edit = $request->couriers_edit;
        $role->couriers_delete = $request->couriers_delete;
        $role->employees = $request->employees;
        $role->employees_create = $request->employees_create;
        $role->employees_edit = $request->employees_edit;
        $role->employees_delete = $request->employees_delete;
        $role->vehicle = $request->vehicle;
        $role->vehicle_create = $request->vehicle_create;
        $role->vehicle_edit = $request->vehicle_edit;
        $role->vehicle_delete = $request->vehicle_delete;
        $role->vehicle_group = $request->vehicle_group;
        $role->vehicle_group_create = $request->vehicle_group_create;
        $role->vehicle_group_edit = $request->vehicle_group_edit;
        $role->vehicle_group_delete = $request->vehicle_group_delete;
        $role->vehicle_type = $request->vehicle_type;
        $role->vehicle_type_create = $request->vehicle_type_create;
        $role->vehicle_type_edit = $request->vehicle_type_edit;
        $role->vehicle_type_delete = $request->vehicle_type_delete;
        $role->shipment_report = $request->shipment_report;
        $role->revenue_report = $request->revenue_report;
        $role->agent_report = $request->agent_report;
        $role->generate_invoice = $request->generate_invoice;
        $role->guest_generate_invoice = $request->guest_generate_invoice;
        $role->invoice_history = $request->invoice_history;
        $role->courier_team_cod_settlement_report = $request->courier_team_cod_settlement_report;
        $role->courier_team_guest_settlement_report = $request->courier_team_guest_settlement_report;
        $role->accounts_team_settlement_report = $request->accounts_team_settlement_report;
        $role->payments_out_report = $request->payments_out_report;
        $role->country = $request->country;
        $role->country_create = $request->country_create;
        $role->country_edit = $request->country_edit;
        $role->country_delete = $request->country_delete;
        $role->package_category = $request->package_category;
        $role->package_category_create = $request->package_category_create;
        $role->package_category_edit = $request->package_category_edit;
        $role->package_category_delete = $request->package_category_delete;
        $role->exception_category = $request->exception_category;
        $role->exception_category_create = $request->exception_category_create;
        $role->exception_category_edit = $request->exception_category_edit;
        $role->exception_category_delete = $request->exception_category_delete;
        $role->complaint_request = $request->complaint_request;
        $role->complaint_request_create = $request->complaint_request_create;
        $role->complaint_request_edit = $request->complaint_request_edit;
        $role->complaint_request_delete = $request->complaint_request_delete;
        $role->push_notification = $request->push_notification;
        $role->push_notification_create = $request->push_notification_create;
        $role->push_notification_edit = $request->push_notification_edit;
        $role->push_notification_delete = $request->push_notification_delete;
        $role->station = $request->station;
        $role->station_create = $request->station_create;
        $role->station_edit = $request->station_edit;
        $role->station_delete = $request->station_delete;
        $role->financial_settings = $request->financial_settings;
        $role->common_price = $request->common_price;
        $role->terms_and_conditions = $request->terms_and_conditions;
        $role->social_media_links = $request->social_media_links;
        $role->working_hours = $request->working_hours;
        $role->languages = $request->languages;
        $role->shipment_logs = $request->shipment_logs;
        $role->system_logs = $request->system_logs;
        $role->roles = $request->roles;
        $role->roles_create = $request->roles_create;
        $role->roles_edit = $request->roles_edit;
        $role->roles_delete = $request->roles_delete;
        $role->save();
        return response()->json('successfully save'); 
    }
    public function updateRole(Request $request){
        $request->validate([
            'role_name'=> 'required',
        ]);

        $role = role::find($request->id);
        $role->role_name = $request->role_name;
        $role->dashboard = $request->dashboard;
        $role->all_customer = $request->all_customer;
        $role->all_customer_edit = $request->all_customer_edit;
        $role->all_customer_delete = $request->all_customer_delete;
        $role->new_customer = $request->new_customer;
        $role->new_customer_edit = $request->new_customer_edit;
        $role->new_customer_delete = $request->new_customer_delete;
        $role->sales_team = $request->sales_team;
        $role->sales_team_edit = $request->sales_team_edit;
        $role->sales_team_delete = $request->sales_team_delete;
        $role->accounts_team = $request->accounts_team;
        $role->accounts_team_edit = $request->accounts_team_edit;
        $role->accounts_team_delete = $request->accounts_team_delete;
        $role->create_shipment = $request->create_shipment;
        $role->create_special_shipment = $request->create_special_shipment;
        $role->all_shipment = $request->all_shipment;
        $role->revenue_exception = $request->revenue_exception;
        $role->cancel_shipment = $request->cancel_shipment;
        $role->shipment_hold = $request->shipment_hold;
        $role->new_pickup_request = $request->new_pickup_request;
        $role->new_pickup_request_edit = $request->new_pickup_request_edit;
        $role->guest_pickup_request = $request->guest_pickup_request;
        $role->guest_pickup_request_edit = $request->guest_pickup_request_edit;
        $role->today_bulk_pickup_request = $request->today_bulk_pickup_request;
        $role->today_bulk_pickup_request_edit = $request->today_bulk_pickup_request_edit;
        $role->future_bulk_pickup_request = $request->future_bulk_pickup_request;
        $role->future_bulk_pickup_request_edit = $request->future_bulk_pickup_request_edit;
        $role->pickup_assigned = $request->pickup_assigned;
        $role->pickup_exception = $request->pickup_exception;
        $role->pickup_exception_edit = $request->pickup_exception_edit;
        $role->package_collected = $request->package_collected;
        $role->transit_in = $request->transit_in;
        $role->transit_out = $request->transit_out;
        $role->package_at_station = $request->package_at_station;
        $role->van_for_delivery = $request->van_for_delivery;
        $role->delivery_exception = $request->delivery_exception;
        $role->shipment_delivered = $request->shipment_delivered;
        $role->today_delivery = $request->today_delivery;
        $role->future_delivery = $request->future_delivery;
        $role->couriers = $request->couriers;
        $role->couriers_create = $request->couriers_create;
        $role->couriers_edit = $request->couriers_edit;
        $role->couriers_delete = $request->couriers_delete;
        $role->employees = $request->employees;
        $role->employees_create = $request->employees_create;
        $role->employees_edit = $request->employees_edit;
        $role->employees_delete = $request->employees_delete;
        $role->vehicle = $request->vehicle;
        $role->vehicle_create = $request->vehicle_create;
        $role->vehicle_edit = $request->vehicle_edit;
        $role->vehicle_delete = $request->vehicle_delete;
        $role->vehicle_group = $request->vehicle_group;
        $role->vehicle_group_create = $request->vehicle_group_create;
        $role->vehicle_group_edit = $request->vehicle_group_edit;
        $role->vehicle_group_delete = $request->vehicle_group_delete;
        $role->vehicle_type = $request->vehicle_type;
        $role->vehicle_type_create = $request->vehicle_type_create;
        $role->vehicle_type_edit = $request->vehicle_type_edit;
        $role->vehicle_type_delete = $request->vehicle_type_delete;
        $role->shipment_report = $request->shipment_report;
        $role->revenue_report = $request->revenue_report;
        $role->agent_report = $request->agent_report;
        $role->generate_invoice = $request->generate_invoice;
        $role->guest_generate_invoice = $request->guest_generate_invoice;
        $role->invoice_history = $request->invoice_history;
        $role->courier_team_cod_settlement_report = $request->courier_team_cod_settlement_report;
        $role->courier_team_guest_settlement_report = $request->courier_team_guest_settlement_report;
        $role->accounts_team_settlement_report = $request->accounts_team_settlement_report;
        $role->payments_out_report = $request->payments_out_report;
        $role->country = $request->country;
        $role->country_create = $request->country_create;
        $role->country_edit = $request->country_edit;
        $role->country_delete = $request->country_delete;
        $role->package_category = $request->package_category;
        $role->package_category_create = $request->package_category_create;
        $role->package_category_edit = $request->package_category_edit;
        $role->package_category_delete = $request->package_category_delete;
        $role->exception_category = $request->exception_category;
        $role->exception_category_create = $request->exception_category_create;
        $role->exception_category_edit = $request->exception_category_edit;
        $role->exception_category_delete = $request->exception_category_delete;
        $role->complaint_request = $request->complaint_request;
        $role->complaint_request_create = $request->complaint_request_create;
        $role->complaint_request_edit = $request->complaint_request_edit;
        $role->complaint_request_delete = $request->complaint_request_delete;
        $role->push_notification = $request->push_notification;
        $role->push_notification_create = $request->push_notification_create;
        $role->push_notification_edit = $request->push_notification_edit;
        $role->push_notification_delete = $request->push_notification_delete;
        $role->station = $request->station;
        $role->station_create = $request->station_create;
        $role->station_edit = $request->station_edit;
        $role->station_delete = $request->station_delete;
        $role->financial_settings = $request->financial_settings;
        $role->common_price = $request->common_price;
        $role->terms_and_conditions = $request->terms_and_conditions;
        $role->social_media_links = $request->social_media_links;
        $role->working_hours = $request->working_hours;
        $role->languages = $request->languages;
        $role->shipment_logs = $request->shipment_logs;
        $role->system_logs = $request->system_logs;
        $role->roles = $request->roles;
        $role->roles_create = $request->roles_create;
        $role->roles_edit = $request->roles_edit;
        $role->roles_delete = $request->roles_delete;
        $role->save();
        return response()->json('successfully update'); 
    }

    public function Role(){
        $role = role::all();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.role',compact('role','language','role_get'));
    }

    public function editRole($id){
        $language = language::all();
        $role = role::find($id);
        return view('admin.edit_role',compact('role','language'));
    }
    
    public function deleteRole($id,$status){
        $user = role::find($id);
        $user->status = $status;
        $user->save();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function createRole(){
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        $language = language::all();
        return view('admin.create_role',compact('language','role_get'));
    }

}
