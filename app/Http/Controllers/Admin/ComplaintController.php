<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use App\Models\complaint;
use App\Models\language;
use App\Models\role;
use App\Http\Controllers\Admin\logController;
use Auth;

class ComplaintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function savecomplaint(Request $request){
        $request->validate([
            'track_id'=> 'required',
        ]);

        $complaint = new complaint;
        $complaint->name = $request->name;
        $complaint->email = $request->email;
        $complaint->mobile = $request->mobile;
        $complaint->track_id = $request->track_id;
        $complaint->damage_category = $request->damage_category;
        $complaint->complaint_category = $request->complaint_category;
        $complaint->description = $request->description;
        $complaint->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Save Complaint Track ID : '.$complaint->track_id.'");


        return response()->json('successfully save'); 
    }
    public function updatecomplaint(Request $request){
        $request->validate([
            'track_id'=> 'required',
        ]);
        
        $complaint = complaint::find($request->id);
        $complaint->name = $request->name;
        $complaint->email = $request->email;
        $complaint->mobile = $request->mobile;
        $complaint->track_id = $request->track_id;
        $complaint->damage_category = $request->damage_category;
        $complaint->complaint_category = $request->complaint_category;
        $complaint->description = $request->description;
        $complaint->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Complaint Track ID : '.$complaint->track_id.'");

        return response()->json('successfully update'); 
    }

    public function complaint(){
        $complaint = complaint::orderBy('id','DESC')->get();
        $station = station::all();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.complaint',compact('complaint','station','language','role_get'));
    }

    public function editcomplaint($id){
        $complaint = complaint::find($id);
        return response()->json($complaint); 
    }
    
    public function deletecomplaint($id,$status){
        $complaint = complaint::find($id);
        $complaint->status = $status;
        $complaint->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Complaint Track ID : '.$complaint->track_id.'");

        return response()->json(['message'=>'Successfully Delete'],200); 
    }
}
