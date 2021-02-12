<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\agent;
use App\Models\city;
use App\Models\language;
use Hash;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function saveAgent(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'driving_license'=>'required',
            'emirates_id'=>'required',
            'vehicle_number'=>'required',
            'city_id'=>'required',
            //'area_ids'=>'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'driving_license_file' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
            'emirates_id_file' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'driving_license_file.mimes' => 'Only jpeg, png and jpg images are allowed',
            'driving_license_file.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'emirates_id_file.mimes' => 'Only jpeg, png and jpg images are allowed',
            'emirates_id_file.max' => 'Sorry! Maximum allowed size for an image is 1MB',
        ]);

        $agent = new agent;
        $agent->agent_id = $request->agent_id;
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->mobile = $request->mobile;
        $agent->dob = $request->dob;
        $agent->gender = $request->gender;
        $agent->driving_license = $request->driving_license;
        $agent->emirates_id = $request->emirates_id;
        $agent->vehicle_number = $request->vehicle_number;
        $agent->vehicle_details = $request->vehicle_details;
        $agent->city_id = $request->city_id;
        //$agent->area_ids = $request->area_ids;
        $agent->password = Hash::make($request->password);

        $agent->pickup = $request->pickup;
        $agent->delivery = $request->delivery;
        $agent->van_scan = $request->van_scan;
        $agent->hub = $request->hub;
        $agent->revenue_exception = $request->revenue_exception;
        $agent->cash_report = $request->cash_report;

        if($request->driving_license_file!=""){
            if($request->file('driving_license_file')!=""){
            $image = $request->file('driving_license_file');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $agent->driving_license_file = $upload_image;
            }
        }
        if($request->emirates_id_file!=""){
            if($request->file('emirates_id_file')!=""){
            $image = $request->file('emirates_id_file');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $agent->emirates_id_file = $upload_image;
            }
        }
        $agent->save();
        return response()->json('successfully save'); 
    }
    public function updateAgent(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'driving_license'=>'required',
            'emirates_id'=>'required',
            'vehicle_number'=>'required',
            'city_id'=>'required',
            //'area_ids'=>'required',
            'password' => 'nullable|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'nullable|min:6',
            'driving_license_file' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
            'emirates_id_file' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'driving_license_file.mimes' => 'Only jpeg, png and jpg images are allowed',
            'driving_license_file.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'emirates_id_file.mimes' => 'Only jpeg, png and jpg images are allowed',
            'emirates_id_file.max' => 'Sorry! Maximum allowed size for an image is 1MB',
        ]);
        
        $agent = agent::find($request->id);
        $agent->name = $request->name;
        $agent->agent_id = $request->agent_id;
        $agent->email = $request->email;
        $agent->mobile = $request->mobile;
        $agent->dob = $request->dob;
        $agent->gender = $request->gender;
        $agent->driving_license = $request->driving_license;
        $agent->emirates_id = $request->emirates_id;
        $agent->vehicle_number = $request->vehicle_number;
        $agent->vehicle_details = $request->vehicle_details;
        $agent->city_id = $request->city_id;
        //$agent->area_ids = $request->area_ids;

        $agent->pickup = $request->pickup;
        $agent->delivery = $request->delivery;
        $agent->van_scan = $request->van_scan;
        $agent->hub = $request->hub;
        $agent->revenue_exception = $request->revenue_exception;
        $agent->cash_report = $request->cash_report;

        if($request->password != ''){
            $agent->password = Hash::make($request->password);
        }

        if($request->driving_license_file!=""){
            $old_image = "upload_files/".$agent->driving_license_file;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            if($request->file('driving_license_file')!=""){
            $image = $request->file('driving_license_file');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $agent->driving_license_file = $upload_image;
            }
        }

        if($request->emirates_id_file!=""){
            $old_image = "upload_files/".$agent->emirates_id_file;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            if($request->file('emirates_id_file')!=""){
            $image = $request->file('emirates_id_file');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $agent->emirates_id_file = $upload_image;
            }
        }
        
        $agent->save();
        return response()->json('successfully update'); 
    }

    public function Agent(){
        $agent = agent::all();
        $language = language::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        return view('admin.agent',compact('agent','city','area','language'));
    }

    public function editAgent($id){
        $agent = agent::find($id);
        return response()->json($agent); 
    }
    
    public function deleteAgent($id){
        $agent = agent::find($id);
        $agent->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }
}
