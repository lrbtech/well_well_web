<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\shipment_notes;
use App\Models\shipment_notification;
use App\Models\User;
use App\Models\add_rate;
use App\Models\add_rate_item;
use App\Models\agent;
use App\Models\station;
use App\Models\role;
use App\Models\language;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Mail;
use PDF;

class AllShipment extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function ScheduleForPickup(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.schedule_for_pickup',compact('agent','language'));
    }

    public function NewShipmentRequest(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.new_shipment_request',compact('agent', 'language'));
    }

    public function PickupException(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.pickup_exception',compact('agent','language'));
    }

    public function PackageCollected(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.package_collected',compact('agent','language'));
    }

    public function TransitIn(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.transit_in',compact('agent','language'));
    }

    public function TransitOut(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.transit_out',compact('agent','language'));
    }

    public function ReadyForDelivery(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.ready_for_delivery',compact('agent','language'));
    }

    public function DeliveryException(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.delivery_exception',compact('agent','language'));
    }

    public function ShipmentDelivered(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.shipment_delivered',compact('agent','language'));
    }

    public function CancelRequest(){
        $agent = agent::all();
        $language = language::all();
        return view('admin.cancel_request',compact('agent','language'));
    }

    public function checkboxAssignAgent(Request $request)
    {
        $data = shipment::whereIn('id', $request->id)->get();
        foreach ($data as $row) {
            $shipment = shipment::find($row->id);
            $shipment->pickup_agent_id = $request->agent_id;
            $shipment->pickup_assign_date = date('Y-m-d');
            $shipment->pickup_assign_time = date('H:i:s');
            $shipment->status = 1;
            $shipment->save();
        }
        return response()->json(["Successfully Update"], 200);
    }



    public function getNewShipmentRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',0)->orderBy('id','DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',0)->orderBy('id','DESC')->get();
        }
        
        return Datatables::of($shipment)
            ->addColumn('checkbox', function ($shipment) {
                $today = date('Y-m-d');
                if($today >= $shipment->shipment_date){
                    return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('user_id', function ($shipment) {
                if($shipment->sender_id == '0'){
                    return '<td>Guest</td>';
                }
                else{
                    $user = User::find($shipment->sender_id);
                    return '<td>'.$user->customer_id.'</td>';
                }
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
        
            ->addColumn('status', function ($shipment) {
                if($shipment->status == 0){
                    return 'Shipment Created';
                }
            })

            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                    </div>
                </td>';
            })
           
            
        ->rawColumns(['checkbox','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','status','action','status','user_id'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getScheduleForPickup(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',1)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',1)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('agent', function ($shipment) {
                $agent = agent::find($shipment->agent_id);
                if(!empty($agent)){
                return '<td>
                <p>' . $agent->name . '</p>
                <p>' . $agent->email . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {

                if($shipment->status == 1){
                    $agent = agent::find($shipment->pickup_agent_id);
                    if(!empty($agent)){
                        return 'Schedule for Pickup '.$agent->name;
                    }
                    else{
                        return 'Schedule for Pickup';
                    }
                }
            })
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','agent','action','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getPickupException(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',3)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',3)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('agent', function ($shipment) {
                $agent = agent::find($shipment->agent_id);
                if(!empty($agent)){
                return '<td>
                <p>' . $agent->name . '</p>
                <p>' . $agent->email . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {

                if($shipment->status == 3){
                    return 'Exception';
                    return '<td>
                    <p>Exception</p>
                    <p>' . $shipment->exception_category . '</p>
                    <p>' . $shipment->exception_remark . '</p>
                    </td>';
                }
            })
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','agent','action','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getPackageCollected(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',2)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',2)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('agent', function ($shipment) {
                $agent = agent::find($shipment->agent_id);
                if(!empty($agent)){
                return '<td>
                <p>' . $agent->name . '</p>
                <p>' . $agent->email . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {

                if($shipment->status == 1){
                    $agent = agent::find($shipment->pickup_agent_id);
                    if(!empty($agent)){
                        return 'Schedule for Pickup '.$agent->name;
                    }
                    else{
                        return 'Schedule for Pickup';
                    }
                }
            })
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                        <a class="dropdown-item" href="/admin/pickup-station/'.$shipment->id.'">Received Station Hub</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getTransitIn(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',4)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',4)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('agent', function ($shipment) {
                $agent = agent::find($shipment->agent_id);
                if(!empty($agent)){
                return '<td>
                <p>' . $agent->name . '</p>
                <p>' . $agent->email . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {

                if($shipment->status == 4){
                    $from_station = station::find($shipment->from_station_id);
                    return 'Transit In '.$from_station->station;
                }
            })
            ->addColumn('action', function ($shipment) {
                $output='';
                if($shipment->status == 4){
                    if($shipment->from_station_id == $shipment->to_station_id){
                        $output.='<a onclick="AssignAgentDelivery('.$shipment->id.')" class="dropdown-item">Agent Assign to Delivery</a>';
                    }
                    else{
                        $output.='<a onclick="AssignAgentStation('.$shipment->id.')" class="dropdown-item">Assign Agent to Transit out (Hub)</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                        '.$output.'
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getTransitOut(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',6)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',6)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('agent', function ($shipment) {
                $agent = agent::find($shipment->agent_id);
                if(!empty($agent)){
                return '<td>
                <p>' . $agent->name . '</p>
                <p>' . $agent->email . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {

                if($shipment->status == 6){
                    $to_station = station::find($shipment->to_station_id);
                    return 'Transit Out '.$to_station->station;
                }
            })
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                        <a onclick="AssignAgentDelivery('.$shipment->id.')" class="dropdown-item">Agent Assign to Delivery</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getReadyForDelivery(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',7)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',7)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('agent', function ($shipment) {
                $agent = agent::find($shipment->agent_id);
                if(!empty($agent)){
                return '<td>
                <p>' . $agent->name . '</p>
                <p>' . $agent->email . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {

                if($shipment->status == 7){
                    return 'In the Van for Delivery';
                }
            })
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                        <a href="/admin/shipment-delivery/'.$shipment->id.'" class="dropdown-item">Shipment Delivery</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getShipmentDelivered(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',8)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',8)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('agent', function ($shipment) {
                $agent = agent::find($shipment->agent_id);
                if(!empty($agent)){
                return '<td>
                <p>' . $agent->name . '</p>
                <p>' . $agent->email . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {

                if($shipment->status == 8){
                    return 'Shipment delivered';
                }
            })
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a target="_blank" href="/admin/print-invoice/'.$shipment->id.'" class="dropdown-item">Print</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getDeliveryException(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',9)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',9)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('agent', function ($shipment) {
                $agent = agent::find($shipment->agent_id);
                if(!empty($agent)){
                return '<td>
                <p>' . $agent->name . '</p>
                <p>' . $agent->email . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {

                if($shipment->status == 9){
                    return 'Delivery Exception';
                    return '<td>
                    <p>Exception</p>
                    <p>' . $shipment->delivery_exception_category . '</p>
                    <p>' . $shipment->delivery_exception_remark . '</p>
                    </td>';
                }
            })
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getCancelRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',10)->orWhere('status',11)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',10)->orWhere('status',11)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
                <p><b>Station :' . $from_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('to_address', function ($shipment) {
                $to_address = manage_address::find($shipment->to_address);
                $to_city = city::find($to_address->city_id);
                $to_area = city::find($to_address->area_id);
                $to_station = station::find($shipment->to_station_id);
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                <p><b>Station :' . $to_station->station . '</b></p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('agent', function ($shipment) {
                $agent = agent::find($shipment->agent_id);
                if(!empty($agent)){
                return '<td>
                <p>' . $agent->name . '</p>
                <p>' . $agent->email . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {
                if($shipment->status == 10){
                    return '<td><p>Cancel Request</p> <p>'.$shipment->cancel_remark.'</p></td>';
                }
                elseif($shipment->status == 11){
                    return '
                    <p>Canceled</p>
                    ';
                }
            })
            ->addColumn('action', function ($shipment) {
                $output='';
                if($shipment->status == 10){
                    $output.='<a onclick="ShipmentCancelled('.$shipment->id.')" class="dropdown-item" href="#">Shipment Cancel</a>';
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                        '.$output.'
                   </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



}
