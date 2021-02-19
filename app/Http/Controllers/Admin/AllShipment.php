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
use App\Models\revenue_exception_log;
use App\Models\system_logs;
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

    public function revenueException(){
        $revenue_exception = revenue_exception_log::all();
        $language = language::all();
        return view('admin.revenue_exception',compact('revenue_exception','language'));
    }

    public function NewShipmentRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $agent = agent::all();
        }
        else{
            $q =DB::table('agents as a');
            $q->join('cities as c','a.city_id','=','c.id');
            $q->where('c.station_id', Auth::guard('admin')->user()->station_id);
            $q->select('a.*');
            $agent = $q->get();
        }
        $language = language::all();
        return view('admin.new_shipment_request',compact('agent', 'language'));
    }


    public function GuestPickupRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $agent = agent::all();
        }
        else{
            $q =DB::table('agents as a');
            $q->join('cities as c','a.city_id','=','c.id');
            $q->where('c.station_id', Auth::guard('admin')->user()->station_id);
            $q->select('a.*');
            $agent = $q->get();
        }
        $language = language::all();
        return view('admin.guest_pickup_request',compact('agent', 'language'));
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

    public function TodayPickupRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $agent = agent::all();
        }
        else{
            $q =DB::table('agents as a');
            $q->join('cities as c','a.city_id','=','c.id');
            $q->where('c.station_id', Auth::guard('admin')->user()->station_id);
            $q->select('a.*');
            $agent = $q->get();
        }
        $language = language::all();
        return view('admin.today_pickup_request',compact('agent','language'));
    }

    public function FuturePickupRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $agent = agent::all();
        }
        else{
            $q =DB::table('agents as a');
            $q->join('cities as c','a.city_id','=','c.id');
            $q->where('c.station_id', Auth::guard('admin')->user()->station_id);
            $q->select('a.*');
            $agent = $q->get();
        }
        $language = language::all();
        return view('admin.future_pickup_request',compact('agent','language'));
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


            $agent=agent::find($request->agent_id);
            $system_logs = new system_logs;
            $system_logs->_id = $row->id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = Auth::guard('admin')->user()->email;
            $system_logs->remark = 'Pickup Request to Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            $system_logs->save();
        }
        return response()->json(["Successfully Update"], 200);
    }


    public function BulkCheckboxAssignAgent(Request $request)
    {
        $arraydata=array();
        foreach($request->id as $row){
            foreach(explode(',',$row) as $user1){
            $arraydata[]=$user1;
            }
        }
       
        $data = shipment::whereIn('id', $arraydata)->get();
        foreach ($data as $row) {
            $shipment = shipment::find($row->id);
            $shipment->pickup_agent_id = $request->agent_id;
            $shipment->pickup_assign_date = date('Y-m-d');
            $shipment->pickup_assign_time = date('H:i:s');
            $shipment->status = 1;
            $shipment->save();

            $agent=agent::find($request->agent_id);
            $system_logs = new system_logs;
            $system_logs->_id = $row->id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = Auth::guard('admin')->user()->email;
            $system_logs->remark = 'Pickup Request to Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
            $system_logs->save();
        }
        return response()->json(["Successfully Update"], 200);
    }


    public function getTodayPickupRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            //$shipment = shipment::where('status',0)->orderBy('id','DESC')->get();
            $today = date('Y-m-d');
            $q =DB::table('shipments as s');
            $q->where('s.shipment_date', $today);
            $q->where('s.status', 0);
            $q->where('s.sender_id','!=',0);
            $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
            $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") ,DB::raw("s.from_address") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
            $shipment = $q->get();
        }
        else{
            //$shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',0)->orderBy('id','DESC')->get();
            $q =DB::table('shipments as s');
            $q->where('s.from_station_id', Auth::guard('admin')->user()->station_id);
            $q->where('s.shipment_date',$today);
            $q->where('s.status', 0);
            $q->where('s.sender_id','!=',0);
            $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
            $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")]);
            $shipment = $q->get();
        }
        
        return Datatables::of($shipment)
            ->addColumn('checkbox', function ($shipment) {
                $today = date('Y-m-d');
             $all_shipment = shipment::where('shipment_date',$shipment->shipment_date)->where('sender_id',$shipment->sender_id)->where('from_address',$shipment->from_address)->where('shipment_from_time',$shipment->shipment_from_time)->where('shipment_to_time',$shipment->shipment_to_time)->where('status',0)->get();
                $order_id = '';
                foreach ($all_shipment as $key => $value) {
                    $datas[] = $value->id;
                } 
                $order_id = collect($datas)->implode(',');

                return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $order_id . '"></td>';
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
            ->addColumn('no_of_packages', function ($shipment) {
                return '<td>'.$shipment->no_of_packages.'</td>';
            })

            ->addColumn('no_of_shipments', function ($shipment) {
                return '<td>'.$shipment->no_of_shipments.'</td>';
            })
            
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                <p>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</p>
                </td>';
            })

            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($from_city->station_id);
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
        
            ->addColumn('status', function ($shipment) {
                return 'Ready for Pickup';
            })

            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->sender_id.')" class="dropdown-item" href="#">Print Label</a>
                    </div>
                </td>';
            })
           
            
        ->rawColumns(['checkbox','shipment_date', 'from_address', 'status','action','user_id','no_of_packages','no_of_shipments'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function getFuturePickupRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            //$shipment = shipment::where('status',0)->orderBy('id','DESC')->get();
            $today = date('Y-m-d');
            $q =DB::table('shipments as s');
            $q->where('s.shipment_date','!=',$today);
            $q->where('s.status', 0);
            $q->where('s.sender_id','!=',0);
            $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
            $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") ,DB::raw("s.from_address") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
            $shipment = $q->get();
        }
        else{
            //$shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',0)->orderBy('id','DESC')->get();
            $q =DB::table('shipments as s');
            $q->where('s.from_station_id', Auth::guard('admin')->user()->station_id);
            $q->where('s.shipment_date','!=',$today);
            $q->where('s.status', 0);
            $q->where('s.sender_id','!=',0);
            $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
            $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") ,DB::raw("s.from_address") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
            $shipment = $q->get();
        }
        
        return Datatables::of($shipment)
            ->addColumn('checkbox', function ($shipment) {
                $today = date('Y-m-d');
                $all_shipment = shipment::where('shipment_date',$shipment->shipment_date)->where('sender_id',$shipment->sender_id)->where('from_address',$shipment->from_address)->where('shipment_from_time',$shipment->shipment_from_time)->where('shipment_to_time',$shipment->shipment_to_time)->where('status',0)->get();
                    $order_id = '';
                    foreach ($all_shipment as $key => $value) {
                        $datas[] = $value->id;
                    } 
                    $order_id = collect($datas)->implode(',');

                if($shipment->shipment_date > $today){
                    return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $order_id . '"></td>';
                }
                else{
                    return '<td style="background-color:#FF0000 !important"><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $order_id . '"></td>';
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
            ->addColumn('no_of_packages', function ($shipment) {
                return '<td>'.$shipment->no_of_packages.'</td>';
            })

            ->addColumn('no_of_shipments', function ($shipment) {
                return '<td>'.$shipment->no_of_shipments.'</td>';
            })
            
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                <p>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</p>
                </td>';
            })

            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($from_city->station_id);
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
            
        
            ->addColumn('status', function ($shipment) {
                return 'Ready for Pickup';
            })

            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->sender_id.')" class="dropdown-item" href="#">Print Label</a>
                    </div>
                </td>';
            })
           
            
        ->rawColumns(['checkbox','shipment_date', 'from_address', 'status','action','user_id','no_of_packages','no_of_shipments'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function getNewShipmentRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',0)->where('sender_id','!=',0)->orderBy('id','DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('sender_id','!=',0)->where('status',0)->orderBy('id','DESC')->get();
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
                    return 'Ready for Pickup';
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
           
            
        ->rawColumns(['checkbox','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','status','action','user_id'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getGuestPickupRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',0)->where('sender_id',0)->orderBy('id','DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('sender_id',0)->where('status',0)->orderBy('id','DESC')->get();
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
                    return 'Ready for Pickup';
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
           
            
        ->rawColumns(['checkbox','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','status','action','user_id'])
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
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->pickup_assign_time)).'</td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->pickup_assign_date)) . '</p>
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
                        return '<p>Schedule for Pickup</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
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
        ->addIndexColumn()
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
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->exception_assign_time)).'</td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->exception_assign_date)) . '</p>
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
        ->addIndexColumn()
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
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->package_collect_time)).'</td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->package_collect_date)) . '</p>
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
                $agent = agent::find($shipment->package_collect_agent_id);
                if(!empty($agent)){
                    return '<p>Package Collected</p>
                    <p>Agent ID :'.$agent->agent_id.'</p>
                    <p>Name :' . $agent->name . '</p>';
                }
                else{
                    return 'Package Collected';
                }
            })
            ->addColumn('action', function ($shipment) {
                // <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                // <a class="dropdown-item" href="/admin/pickup-station/'.$shipment->id.'">Received Station Hub</a>
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getTransitIn(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',4)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',4)->orWhere('to_station_id',Auth::guard('admin')->user()->station_id)->orderBy('id', 'DESC')->get();

            // $shipment = DB::table('shipments')
            // ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
            //         ['status','4']])
            // ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
            //         ['status','6']])
            // ->orderBy('id', 'DESC')
            // ->get();
         }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->transit_in_time)).'</td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->transit_in_date)) . '</p>
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
                $from_station = station::find($shipment->from_station_id);
                $agent = agent::find($shipment->transit_in_id);
                if(!empty($agent)){
                    return '
                    <p>Transit In '.$from_station->station.'</p>
                    <p>Agent ID :'.$agent->agent_id.'</p>
                    <p>Name :' . $agent->name . '</p>'
                   ;
                }
                else{
                    return '
                    <p>Transit In '.$from_station->station.'</p>'
                   ;
                }
            })
            ->addColumn('action', function ($shipment) {
                $output='';
                // if($shipment->status == 4){
                //     if($shipment->from_station_id == $shipment->to_station_id){
                //         $output.='<a onclick="AssignAgentDelivery('.$shipment->id.')" class="dropdown-item">Agent Assign to Delivery</a>';
                //     }
                //     else{
                //         $output.='<a onclick="AssignAgentStation('.$shipment->id.')" class="dropdown-item">Assign Agent to Transit out (Hub)</a>';
                //     }
                // }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        '.$output.'
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getTransitOut(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',6)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->orWhere('to_station_id',Auth::guard('admin')->user()->station_id)->where('status',6)->orderBy('id', 'DESC')->get();
            // $shipment = DB::table('shipments')
            // ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
            //         ['status','4']])
            // ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
            //         ['status','6']])
            // ->orderBy('id', 'DESC')
            // ->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->transit_out_time)).'</td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->transit_out_date)) . '</p>
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

                $to_station = station::find($shipment->to_station_id);
                $agent = agent::find($shipment->transit_out_id);
                if(!empty($agent)){
                    return '
                    <p>Transit Out '.$to_station->station.'</p>
                    <p>Agent ID :'.$agent->agent_id.'</p>
                    <p>Name :' . $agent->name . '</p>'
                    ;
                }
                else{
                    return '
                    <p>Transit Out '.$to_station->station.'</p>'
                    ;
                }
            })
            ->addColumn('action', function ($shipment) {
                // <a onclick="AssignAgentDelivery('.$shipment->id.')" class="dropdown-item">Agent Assign to Delivery</a>
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->addIndexColumn()
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
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->van_scan_time)).'</td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->van_scan_date)) . '</p>
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
                $agent = agent::find($shipment->van_scan_id);
                if(!empty($agent)){
                    return '
                    <p>In the Van for Delivery</p>
                    <p>Agent ID :'.$agent->agent_id.'</p>
                    <p>Name :' . $agent->name . '</p>'
                    ;
                }
                else{
                    return '
                    <p>In the Van for Delivery</p>'
                    ;
                }
            })
            ->addColumn('action', function ($shipment) {
                // <a href="/admin/shipment-delivery/'.$shipment->id.'" class="dropdown-item">Shipment Delivery</a>
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->addIndexColumn()
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
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>
                <p>'.date("d-m-Y",strtotime($shipment->delivery_date)).'</p>
                <p>'.date('h:i a',strtotime($shipment->delivery_time)).'</p>
                </td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->delivery_date)) . '</p>
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
                $agent = agent::find($shipment->delivery_agent_id);
                if(!empty($agent)){
                    return '
                    <p>Shipment delivered</p>
                    <p>Agent ID :'.$agent->agent_id.'</p>
                    <p>Name :' . $agent->name . '</p>'
                    ;
                }
                else{
                    return '
                    <p>Shipment delivered</p>'
                    ;
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
        ->addIndexColumn()
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
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->delivery_exception_assign_time)).'</td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->delivery_exception_assign_date)) . '</p>
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
                    return '<td>
                    <p>Delivery Exception</p>
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
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getCancelRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',10)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',10)->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->cancel_request_time)).'</td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->cancel_request_date)) . '</p>
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
                    return '<td><p>Canceled</p> <p>'.$shipment->cancel_remark.'</p></td>';
                }
                // elseif($shipment->status == 11){
                //     return '
                //     <p>Canceled</p>
                //     ';
                // }
            })
            ->addColumn('action', function ($shipment) {
                $output='';
                // if($shipment->status == 10){
                //     $output.='<a onclick="ShipmentCancelled('.$shipment->id.')" class="dropdown-item" href="#">Shipment Cancel</a>';
                // }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        '.$output.'
                   </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



}
