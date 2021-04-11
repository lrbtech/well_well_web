<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\language;
use App\Models\fleet_management;
use App\Models\vehicle_group;
use App\Models\agent;
use App\Models\vehicle_type;
use App\Models\role;
use App\Http\Controllers\Admin\logController;
use Auth;

class FleetManagement extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }
    public function getVehicleType(){
        $vehicle_type = vehicle_type::all();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.vehicle_type',compact('vehicle_type','language','role_get'));
    }
    public function editVehicleType($id){
        $vehicle_type = vehicle_type::find($id);
        return response()->json($vehicle_type); 
    }
    public function deleteVehicleType($id,$status){
        $vehicle_type = vehicle_type::find($id);
        $vehicle_type->status = $status;
        $vehicle_type->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Vehicle Type : '.$vehicle_type->vehicle_type.'");


        return response()->json(['message'=>'Successfully Delete'],200); 
    }
    public function updateVehicleType(Request $request){
        $vehicle_type = vehicle_type::find($request->id);
        $vehicle_type->status = 0;
        $vehicle_type->vehicle_type = $request->vehicle_type;
        $vehicle_type->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Update Vehicle Type : '.$vehicle_type->vehicle_type.'");

        return response()->json(['message'=>'Successfully Update'],200); 
    }
    public function createVehicleType(Request $request){
        $vehicle_type = new vehicle_type;
        $vehicle_type->status = 0;
        $vehicle_type->vehicle_type = $request->vehicle_type;
        $vehicle_type->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Vehicle Type : '.$vehicle_type->vehicle_type.'");

        return response()->json(['message'=>'Successfully Create'],200); 
    }

//vehicle group
    public function getVehicleGroup(){
        $vehicle_group = vehicle_group::all();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.vehicle_group',compact('vehicle_group','language','role_get'));
    }
    public function editVehicleGroup($id){
        $vehicle_group = vehicle_group::find($id);
        return response()->json($vehicle_group); 
    }
    public function deleteVehicleGroup($id,$status){
        $vehicle_group = vehicle_group::find($id);
        $vehicle_group->status = $status;
        $vehicle_group->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Vehicle Group : '.$vehicle_group->vehicle_group.'");

        return response()->json(['message'=>'Successfully Delete'],200); 
    }
    public function updateVehicleGroup(Request $request){
        $vehicle_group = vehicle_group::find($request->id);
        $vehicle_group->status = 0;
        $vehicle_group->vehicle_group = $request->vehicle_group;
        $vehicle_group->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Vehicle Group : '.$vehicle_group->vehicle_group.'");

        return response()->json(['message'=>'Successfully Update'],200); 
    }
    public function createVehicleGroup(Request $request){
        $vehicle_group = new vehicle_group;
        $vehicle_group->status = 0;
        $vehicle_group->vehicle_group = $request->vehicle_group;
        $vehicle_group->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Vehicle Group : '.$vehicle_group->vehicle_group.'");

        return response()->json(['message'=>'Successfully Create'],200); 
    }


    //Fleet Management
    public function getFleet(){
        $vehicle_type = vehicle_type::where('status',0)->get();
        $vehicle_group = vehicle_group::where('status',0)->get();
        $fleet_management = fleet_management::all();
        $agent = agent::where('status',0)->get();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.fleet_management',compact('fleet_management','language','vehicle_type','vehicle_group','agent','role_get'));
    }
    public function editFleet($id){
        $fleet_management = fleet_management::find($id);
        return response()->json($fleet_management); 
    }
    public function deleteFleet($id,$status){
        $fleet_management = fleet_management::find($id);
        $fleet_management->status = $status;
        $fleet_management->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Fleet Management : '.$fleet_management->make.'");

        return response()->json(['message'=>'Successfully Delete'],200); 
    }
    public function updateFleet(Request $request){
        $fleet_management = fleet_management::find($request->id);
        $fleet_management->make = $request->make;
        $fleet_management->model = $request->model;
        $fleet_management->model_year = $request->model_year;
        $fleet_management->color = $request->color;
        $fleet_management->vin = $request->vin;
        $fleet_management->engine = $request->engine;
        $fleet_management->type_vehicle = $request->type_vehicle;
        $fleet_management->department = $request->department;
        $fleet_management->group = $request->group;
        $fleet_management->plate_no = $request->plate_no;
        $fleet_management->type = $request->type;
        $fleet_management->expirataion = $request->expirataion;
        $fleet_management->odometer = $request->odometer;
        $fleet_management->odometer_date = $request->odometer_date;
        $fleet_management->insurance_no = $request->insurance_no;
        $fleet_management->insurance_expire = $request->insurance_expire;
        $fleet_management->oil_change_date = $request->oil_change_date;
        $fleet_management->service_date = $request->service_date;
        $fleet_management->agent_id = $request->agent_id;
        $fleet_management->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Fleet Management : '.$fleet_management->make.'");

        return response()->json(['message'=>'Successfully Update'],200); 
    }
    public function createFleet(Request $request){
       
        $fleet_management = new fleet_management;
        $fleet_management->make = $request->make;
        $fleet_management->model = $request->model;
        $fleet_management->model_year = $request->model_year;
        $fleet_management->color = $request->color;
        $fleet_management->vin = $request->vin;
        $fleet_management->engine = $request->engine;
        $fleet_management->type_vehicle = $request->type_vehicle;
        $fleet_management->department = $request->department;
        $fleet_management->group = $request->group;
        $fleet_management->plate_no = $request->plate_no;
        $fleet_management->type = $request->type;
        $fleet_management->expirataion = $request->expirataion;
        $fleet_management->odometer = $request->odometer;
        $fleet_management->odometer_date = $request->odometer_date;
        $fleet_management->insurance_no = $request->insurance_no;
        $fleet_management->insurance_expire = $request->insurance_expire;
        $fleet_management->oil_change_date = $request->oil_change_date;
        $fleet_management->service_date = $request->service_date;
        $fleet_management->agent_id = $request->agent_id;
        $fleet_management->status = 0;
        $fleet_management->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Fleet Management : '.$fleet_management->make.'");

        return response()->json(['message'=>'Successfully Create'],200); 
    }

    //Remainder Management
    public function getRemainder(){
        //$fleet_management = fleet_management::whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(dob) AND DAYOFYEAR(curdate()) + 7 >=  dayofyear(dob)')->orderByRaw('DAYOFYEAR(dob)')->get();

        $vehicle_type = vehicle_type::where('status',0)->get();
        $vehicle_group = vehicle_group::where('status',0)->get();
        $fleet_management = fleet_management::where('status',0)->get();
        $agent = agent::where('status',0)->get();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.fleet_remainder',compact('fleet_management','language','vehicle_type','vehicle_group','agent','role_get'));
    }

}