<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\language;
use App\Models\fleet_management;
use App\Models\vehicle_group;
use App\Models\vehicle_type;
class FleetManagement extends Controller
{
    public function getVehicleType(){
        $vehicle_type = vehicle_type::where('status',0)->get();
        $language = language::all();
        return view('admin.vehicle_type',compact('vehicle_type','language'));
    }
    public function editVehicleType($id){
        $vehicle_type = vehicle_type::find($id);
        return response()->json($vehicle_type); 
    }
    public function deleteVehicleType($id){
        $vehicle_type = vehicle_type::find($id);
        $vehicle_type->status = 1;
        $vehicle_type->save();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }
    public function updateVehicleType(Request $request){
        $vehicle_type = vehicle_type::find($request->id);
        $vehicle_type->status = 0;
        $vehicle_type->vehicle_type = $request->vehicle_type;
        $vehicle_type->save();
        return response()->json(['message'=>'Successfully Update'],200); 
    }
    public function createVehicleType(Request $request){
        $vehicle_type = new vehicle_type;
        $vehicle_type->status = 0;
        $vehicle_type->vehicle_type = $request->vehicle_type;
        $vehicle_type->save();
        return response()->json(['message'=>'Successfully Create'],200); 
    }

//vehicle group
    public function getVehicleGroup(){
        $vehicle_group = vehicle_group::where('status',0)->get();
        $language = language::all();
        return view('admin.vehicle_group',compact('vehicle_group','language'));
    }
    public function editVehicleGroup($id){
        $vehicle_group = vehicle_group::find($id);
        return response()->json($vehicle_group); 
    }
    public function deleteVehicleGroup($id){
        $vehicle_group = vehicle_group::find($id);
        $vehicle_group->status = 1;
        $vehicle_group->save();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }
    public function updateVehicleGroup(Request $request){
        $vehicle_group = vehicle_group::find($request->id);
        $vehicle_group->status = 0;
        $vehicle_group->vehicle_group = $request->vehicle_group;
        $vehicle_group->save();
        return response()->json(['message'=>'Successfully Update'],200); 
    }
    public function createVehicleGroup(Request $request){
        $vehicle_group = new vehicle_group;
        $vehicle_group->status = 0;
        $vehicle_group->vehicle_group = $request->vehicle_group;
        $vehicle_group->save();
        return response()->json(['message'=>'Successfully Create'],200); 
    }


    //Fleet Management
    public function getFleet(){
        $vehicle_type = vehicle_type::where('status',0)->get();
        $vehicle_group = vehicle_group::where('status',0)->get();
        $fleet_management = fleet_management::where('status',0)->get();
        $language = language::all();
        return view('admin.fleet_management',compact('fleet_management','language','vehicle_type','vehicle_group'));
    }
    public function editFleet($id){
        $fleet_management = fleet_management::find($id);
        return response()->json($fleet_management); 
    }
    public function deleteFleet($id){
        $fleet_management = fleet_management::find($id);
        $fleet_management->status = 1;
        $fleet_management->save();
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
        return response()->json(['message'=>'Successfully Create'],200); 
    }

    //Remainder Management
    public function getRemainder(){
        $fleet_management = fleet_management::where('status',0)->get();
        $language = language::all();
        return view('admin.fleet_remainder',compact('fleet_management','language'));
    }

}