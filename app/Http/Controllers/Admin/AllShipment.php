<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\drop_point;
use App\Models\country;
use App\Models\city;
use App\Models\shipment_category;
use App\Models\exception_category;
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
use App\Http\Controllers\Admin\logController;

class AllShipment extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function getagentdetails($id){ 
        if($id == 0){
            $agent = agent::where('status',0)->get();
        }
        else{
            $q =DB::table('agents as a');
            $q->join('cities as c','a.city_id','=','c.id');
            $q->where('c.station_id', $id);
            $q->select('a.*');
            $agent = $q->get();
        }
        $output ='<option value="">Select Driver</option>';
        foreach ($agent as $key => $value) {
            $output .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        echo $output;
    }

    public function PickupExceptionDelete($id){
        $shipment = shipment::find($id);
        $shipment->show_status = 1;
        $shipment->save();

        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function ScheduleForPickup(){
        $agent = agent::all();
        $station = station::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.schedule_for_pickup',compact('agent','language','role_get','station'));
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
        $station = station::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.new_shipment_request',compact('agent', 'language','role_get','station'));
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
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        $station = station::all();
        return view('admin.guest_pickup_request',compact('agent', 'language','role_get','station'));
    }

    public function PickupException(){
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
        $exception_category = exception_category::where('exception_status',0)->where('status',0)->get();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        $station = station::all();
        return view('admin.pickup_exception',compact('agent','language','exception_category','role_get','station'));
    }

    public function PackageCollected(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        $station = station::all();
        return view('admin.package_collected',compact('agent','language','role_get','station'));
    }

    public function TransitIn(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.transit_in',compact('agent','language','role_get'));
    }

    public function TransitOut(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.transit_out',compact('agent','language','role_get'));
    }

    public function PackageAtStation(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.package_at_station',compact('agent','language','role_get'));
    }

    public function ReadyForDelivery(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        $station = station::all();
        return view('admin.ready_for_delivery',compact('agent','language','role_get','station'));
    }

    public function DeliveryException(){
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
        $exception_category = exception_category::where('exception_status',1)->where('status',0)->get();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.delivery_exception',compact('agent','language','exception_category','role_get'));
    }

    public function ShipmentDelivered(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.shipment_delivered',compact('agent','language','role_get'));
    }

    public function TodayDelivery(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.today_delivery',compact('agent','language','role_get'));
    }

    public function FutureDelivery(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.future_delivery',compact('agent','language','role_get'));
    }

    public function CancelRequest(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.cancel_request',compact('agent','language','role_get'));
    }

    public function HoldRequest(){
        $agent = agent::all();
        $language = language::all();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.hold_request',compact('agent','language','role_get'));
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
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        $station = station::all();
        return view('admin.today_pickup_request',compact('agent','language','role_get','station'));
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
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        $station = station::all();
        return view('admin.future_pickup_request',compact('agent','language','role_get','station'));
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


    public function getshipmentdetails($id)
    {
        $arraydata=array();
        foreach(explode(',',$id) as $user1){
        $arraydata[]=$user1;
        }
       
        $data = shipment_package::whereIn('shipment_id', $arraydata)->get();
        $output = '<table class="display">
        <thead>
          <tr>
            <th style="width:20%;">Tracking ID</th>
            <th style="width:20%;">Category</th>
            <th style="width:30%;">Description</th>
            <th style="width:20%;">Length * Width * Height</th>
            <th style="width:10%;">Weight</th>
          </tr>
        </thead>
        <tbody>';
           foreach ($data as $value) {
            $category = package_category::find($value->category);
            $output .='<tr>
                <td>'.$value->sku_value.'</td>
                <td>'.$category->category.'</td>
                <td>'.$value->description.'</td>
                <td>'.$value->length.' * '.$value->width.' *  '.$value->height.'</td>
                <td>'.$value->weight.' Kg</td>
            </tr>';
           }
           $output .='</tbody>
        </table>';

        echo $output;
    }



    public function getTodayPickupRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            //$shipment = shipment::where('status',0)->orderBy('id','DESC')->get();
            $today = date('Y-m-d');
            $q =DB::table('shipments as s');
            $q->where('s.shipment_date', $today);
            $q->where('s.status', 0);
            $q->where('s.sender_id','!=',0);
            $q->where('s.hold_status',0);
            $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
            $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") ,DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
            $shipment = $q->get();
        }
        else{
            //$shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',0)->orderBy('id','DESC')->get();
            $today = date('Y-m-d');
            $q =DB::table('shipments as s');
            $q->where('s.from_station_id', Auth::guard('admin')->user()->station_id);
            $q->where('s.shipment_date',$today);
            $q->where('s.status', 0);
            $q->where('s.sender_id','!=',0);
            $q->where('s.hold_status',0);
            $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
            $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")]);
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
                $today = date('Y-m-d');
                $all_shipment = shipment::where('shipment_date',$shipment->shipment_date)->where('sender_id',$shipment->sender_id)->where('from_address',$shipment->from_address)->where('shipment_from_time',$shipment->shipment_from_time)->where('shipment_to_time',$shipment->shipment_to_time)->where('status',0)->get();
                $order_id = '';
                foreach ($all_shipment as $key => $value) {
                    $datas[] = $value->id;
                } 
                $order_id = collect($datas)->implode(',');
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="ShowShipment('.$order_id.')" class="dropdown-item" href="#">Show Shipment</a>
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
            $q->where('s.hold_status',0);
            $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
            $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
            $shipment = $q->get();
        }
        else{
            //$shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',0)->orderBy('id','DESC')->get();
            $today = date('Y-m-d');
            $q =DB::table('shipments as s');
            $q->where('s.from_station_id', Auth::guard('admin')->user()->station_id);
            $q->where('s.shipment_date','!=',$today);
            $q->where('s.status', 0);
            $q->where('s.sender_id','!=',0);
            $q->where('s.hold_status',0);
            $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
            $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
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
                $today = date('Y-m-d');
                $all_shipment = shipment::where('shipment_date',$shipment->shipment_date)->where('sender_id',$shipment->sender_id)->where('from_address',$shipment->from_address)->where('shipment_from_time',$shipment->shipment_from_time)->where('shipment_to_time',$shipment->shipment_to_time)->where('status',0)->get();
                $order_id = '';
                foreach ($all_shipment as $key => $value) {
                    $datas[] = $value->id;
                } 
                $order_id = collect($datas)->implode(',');
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="ShowShipment('.$order_id.')" class="dropdown-item" href="#">Show Shipment</a>
                    </div>
                </td>';
            })
           
            
        ->rawColumns(['checkbox','shipment_date', 'from_address', 'status','action','user_id','no_of_packages','no_of_shipments'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function getNewShipmentRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',0)->where('sender_id','!=',0)->orderBy('id','DESC')->where('hold_status',0)->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('sender_id','!=',0)->where('status',0)->orderBy('id','DESC')->where('hold_status',0)->get();
        }
        
        return Datatables::of($shipment)
            ->addColumn('checkbox', function ($shipment) {
                $today = date('Y-m-d');
                //if($today >= $shipment->shipment_date){
                    return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
                //}
                // else{
                //     return '<td></td>';
                // }
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
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        '.$output2.'
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                    </div>
                </td>';
            })
           
            
        ->rawColumns(['checkbox','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','status','action','user_id'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getGuestPickupRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',0)->where('sender_id',0)->orderBy('id','DESC')->where('hold_status',0)->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('sender_id',0)->where('status',0)->orderBy('id','DESC')->where('hold_status',0)->get();
        }
        
        return Datatables::of($shipment)
            ->addColumn('checkbox', function ($shipment) {
                $today = date('Y-m-d');
                //if($today >= $shipment->shipment_date){
                    return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
                // }
                // else{
                //     return '<td></td>';
                // }
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
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                    </div>
                </td>';
            })
           
            
        ->rawColumns(['checkbox','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','status','action','user_id'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getScheduleForPickup($fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        if(Auth::guard('admin')->user()->station_id == '0'){      
            $i =DB::table('shipments');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('shipments.pickup_assign_date', [$fdate1, $tdate1]);
            }
            $i->where('shipments.status',1);
            $i->where('shipments.hold_status',0);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }
        else{
            $i =DB::table('shipments');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('shipments.pickup_assign_date', [$fdate1, $tdate1]);
            }
            $i->where('shipments.from_station_id',Auth::guard('admin')->user()->station_id);
            $i->where('shipments.status',1);
            $i->where('shipments.hold_status',0);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }

        return Datatables::of($shipment)
            ->addColumn('checkbox', function ($shipment) {
                return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
            })
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->pickup_assign_time)).'</td>';
            })
            ->addColumn('total_weight', function ($shipment) {
                return '<td>
                <p>No of Packages : ' .$shipment->no_of_packages . '</p>
                <p>Total Weight ' .$shipment->total_weight . ' Kg</p>
                </td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        '.$output2.'
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status','total_weight','checkbox'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getPickupException($category){
        if(Auth::guard('admin')->user()->station_id == '0'){
            //$shipment = shipment::where('status',3)->orderBy('id', 'DESC')->where('hold_status',0)->get();
            $i =DB::table('shipments');
            if ( $category != 'category' )
            {
                $i->where('shipments.exception_category', $category);
            }
            $i->where('shipments.status',3);
            $i->where('shipments.hold_status',0);
            $i->where('shipments.show_status',0);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }
        else{
            //$shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',3)->orderBy('id', 'DESC')->where('hold_status',0)->get();
            $i =DB::table('shipments');
            if ( $category != 'category' )
            {
                $i->where('shipments.exception_category', $category);
            }
            $i->where('shipments.status',3);
            $i->where('shipments.hold_status',0);
            $i->where('shipments.show_status',0);
            $i->where('shipments.from_station_id',Auth::guard('admin')->user()->station_id);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }

        return Datatables::of($shipment)
            ->addColumn('checkbox', function ($shipment) {
                $today = date('Y-m-d');
                //if($today >= $shipment->shipment_date){
                    return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
                //}
                // else{
                //     return '<td></td>';
                // }
            })
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->exception_assign_time)).'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a onclick="DeleteShipment('.$shipment->id.')" class="dropdown-item" href="#">Delete</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status','checkbox'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getPackageCollected($fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        if(Auth::guard('admin')->user()->station_id == '0'){
            $i =DB::table('shipments');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('shipments.package_collect_date', [$fdate1, $tdate1]);
            }
            $i->where('shipments.status',2);
            $i->where('shipments.hold_status',0);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }
        else{
            $i =DB::table('shipments');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('shipments.package_collect_date', [$fdate1, $tdate1]);
            }
            $i->where('shipments.from_station_id',Auth::guard('admin')->user()->station_id);
            $i->where('shipments.status',2);
            $i->where('shipments.hold_status',0);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
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
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getTransitIn(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',4)->orWhere('status',11)->where('hold_status',0)->orderBy('id', 'DESC')->get();
        }
        else{
            // $shipment = shipment::where('status',4)->where('from_station_id',Auth::guard('admin')->user()->station_id)->orWhere('status',11)->orWhere('to_station_id',Auth::guard('admin')->user()->station_id)->where('hold_status',0)->orderBy('id', 'DESC')->get();

            $shipment = DB::table('shipments')
            ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','4']])
            ->orWhere([['from_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','11']])
            ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','4']])
            ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','11']])
            ->where('hold_status',0)->orderBy('id', 'DESC')
            ->get();
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
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>'.date('d-m-Y',strtotime($shipment->transit_in_date)).'</td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                    if($shipment->status == 4){
                        return '<td>
                        <p>' . $from_area->city . '</p>
                        <p>' . $from_city->city . '</p>
                        <p style="background-color:#008000;"><b>Station :' . $from_station->station . '</b></p>
                        </td>';
                    }
                    else{
                        return '<td>
                        <p>' . $from_area->city . '</p>
                        <p>' . $from_city->city . '</p>
                        <p><b>Station :' . $from_station->station . '</b></p>
                        </td>';
                    }
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
                    if($shipment->status == 11){
                        return '<td>
                        <p>' . $to_area->city . '</p>
                        <p>' . $to_city->city . '</p>
                        <p style="background-color:#008000;"><b>Station :' . $to_station->station . '</b></p>
                        </td>';
                    }
                    else{
                        return '<td>
                        <p>' . $to_area->city . '</p>
                        <p>' . $to_city->city . '</p>
                        <p><b>Station :' . $to_station->station . '</b></p>
                        </td>';
                    }
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {
                $from_station = station::find($shipment->from_station_id);
                $to_station = station::find($shipment->to_station_id);
                
                if($shipment->status == 4){
                    $agent = agent::find($shipment->transit_in_id);
                }
                elseif($shipment->status == 11){
                    $agent = agent::find($shipment->transit_in_id1);
                }
                if(!empty($agent)){
                    if($shipment->status == 4){
                        return '<p>Transit In '.$from_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                    elseif($shipment->status == 11){
                        return '<p>Transit In '.$to_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
                else{
                    if($shipment->status == 4){
                        return '<p>Transit In '.$from_station->station.'</p>';
                    }
                    elseif($shipment->status == 11){
                        return '<p>Transit In '.$to_station->station.'</p>';
                    }
                }
                
            })
            ->addColumn('action', function ($shipment) {
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getTransitOut(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',6)->orWhere('status',12)->where('hold_status',0)->orderBy('id', 'DESC')->get();
        }
        else{
            // $shipment = shipment::where('status',6)->orWhere('status',12)->where('from_station_id',Auth::guard('admin')->user()->station_id)->orWhere('to_station_id',Auth::guard('admin')->user()->station_id)->where('hold_status',0)->orderBy('id', 'DESC')->get();
            $shipment = DB::table('shipments')
            ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','6']])
            ->orWhere([['from_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','12']])
            ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','6']])
            ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','12']])
            ->where('hold_status',0)->orderBy('id', 'DESC')
            ->get();
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
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>'.date('d-m-Y',strtotime($shipment->transit_out_date)).'</td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                    if($shipment->status == 6){
                        return '<td>
                        <p>' . $from_area->city . '</p>
                        <p>' . $from_city->city . '</p>
                        <p style="background-color:#008000;"><b>Station :' . $from_station->station . '</b></p>
                        </td>';
                    }
                    else{
                        return '<td>
                        <p>' . $from_area->city . '</p>
                        <p>' . $from_city->city . '</p>
                        <p><b>Station :' . $from_station->station . '</b></p>
                        </td>';
                    }
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
                    if($shipment->status == 12){
                        return '<td>
                        <p>' . $to_area->city . '</p>
                        <p>' . $to_city->city . '</p>
                        <p style="background-color:#008000;"><b>Station :' . $to_station->station . '</b></p>
                        </td>';
                    }
                    else{
                        return '<td>
                        <p>' . $to_area->city . '</p>
                        <p>' . $to_city->city . '</p>
                        <p><b>Station :' . $to_station->station . '</b></p>
                        </td>';
                    }
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {
                $from_station = station::find($shipment->from_station_id);
                $to_station = station::find($shipment->to_station_id);
                
                if($shipment->status == 6){
                    $agent = agent::find($shipment->transit_out_id);
                }
                elseif($shipment->status == 12){
                    $agent = agent::find($shipment->transit_out_id1);
                }
                if(!empty($agent)){
                    if($shipment->status == 6){
                        return '<p>Transit Out '.$from_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                    elseif($shipment->status == 12){
                        return '<p>Transit Out '.$to_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
                else{
                    if($shipment->status == 6){
                        return '<p>Transit Out '.$from_station->station.'</p>';
                    }
                    elseif($shipment->status == 12){
                        return '<p>Transit Out '.$to_station->station.'</p>';
                    }
                }
            })
            ->addColumn('action', function ($shipment) {
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function getPackageAtStation(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',13)->orWhere('status',14)->where('hold_status',0)->orderBy('id', 'DESC')->get();
        }
        else{
            // $shipment = shipment::where('status',6)->orWhere('status',12)->where('from_station_id',Auth::guard('admin')->user()->station_id)->orWhere('to_station_id',Auth::guard('admin')->user()->station_id)->where('hold_status',0)->orderBy('id', 'DESC')->get();
            $shipment = DB::table('shipments')
            ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','13']])
            ->orWhere([['from_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','14']])
            ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','13']])
            ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','14']])
            ->where('hold_status',0)->orderBy('id', 'DESC')
            ->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->package_at_station_time)).'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>'.date('d-m-Y',strtotime($shipment->package_at_station_date)).'</td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                if(!empty($from_area)){
                    if($shipment->status == 13){
                        return '<td>
                        <p>' . $from_area->city . '</p>
                        <p>' . $from_city->city . '</p>
                        <p style="background-color:#008000;"><b>Station :' . $from_station->station . '</b></p>
                        </td>';
                    }
                    else{
                        return '<td>
                        <p>' . $from_area->city . '</p>
                        <p>' . $from_city->city . '</p>
                        <p><b>Station :' . $from_station->station . '</b></p>
                        </td>';
                    }
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
                    if($shipment->status == 14){
                        return '<td>
                        <p>' . $to_area->city . '</p>
                        <p>' . $to_city->city . '</p>
                        <p style="background-color:#008000;"><b>Station :' . $to_station->station . '</b></p>
                        </td>';
                    }
                    else{
                        return '<td>
                        <p>' . $to_area->city . '</p>
                        <p>' . $to_city->city . '</p>
                        <p><b>Station :' . $to_station->station . '</b></p>
                        </td>';
                    }
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {
                $from_station = station::find($shipment->from_station_id);
                $to_station = station::find($shipment->to_station_id);
                if($shipment->status == 13){
                    $agent = agent::find($shipment->package_at_station_id);
                }
                elseif($shipment->status == 14){
                    $agent = agent::find($shipment->package_at_station_id1);
                }
                if(!empty($agent)){
                    if($shipment->status == 13){
                        return '<p>Package At Station '.$from_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                    elseif($shipment->status == 14){
                        return '<p>Package At Station '.$to_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
                else{
                    if($shipment->status == 13){
                        return '<p>Package At Station '.$from_station->station.'</p>';
                    }
                    elseif($shipment->status == 14){
                        return '<p>Package At Station '.$to_station->station.'</p>';
                    }
                }
            })
            ->addColumn('action', function ($shipment) {
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getReadyForDelivery(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',7)->where('hold_status',0)->orderBy('id', 'DESC')->get();
        }
        else{
            // $shipment = shipment::where('to_station_id',Auth::guard('admin')->user()->station_id)->where('status',7)->where('hold_status',0)->orderBy('id', 'DESC')->get();
            $shipment = DB::table('shipments')
            ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','7']])
            ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','7']])
            ->where('hold_status',0)->orderBy('id', 'DESC')
            ->get();
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
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getShipmentDelivered($fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment =DB::table('shipments');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $shipment->whereBetween('shipments.delivery_date', [$fdate1, $tdate1]);
            }
            $shipment->where('shipments.status',8);
            $shipment->where('shipments.hold_status',0);
            $shipment->orderBy('shipments.id','DESC');
            //$shipment = $shipment->get();
        }
        else{
            $shipment =DB::table('shipments');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $shipment->whereBetween('shipments.delivery_date', [$fdate1, $tdate1]);
            }
            $shipment->where([['shipments.from_station_id',Auth::guard('admin')->user()->station_id],['shipments.status','8']]);
            $shipment->orWhere([['shipments.to_station_id',Auth::guard('admin')->user()->station_id],['shipments.status','8']]);
            $shipment->where('shipments.hold_status',0);
            $shipment->orderBy('shipments.id','DESC');
            
            //$shipment = $i->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('account_id', function ($shipment) {
                if($shipment->sender_id == '0'){
                    return '<td>Guest</td>';
                }
                else{
                    $user = User::find($shipment->sender_id);
                    return '<td>
                    <p>' . $user->customer_id . '</p>
                    <p>' . $user->first_name . ' ' . $user->last_name . '</p>
                    <p>' . $user->mobile . '</p>
                    </td>';
                }
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>
                <p>'.date("d-m-Y",strtotime($shipment->delivery_date)).'</p>
                <p>'.date('h:i a',strtotime($shipment->delivery_time)).'</p>
                </td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        <a target="_blank" href="/admin/print-invoice/'.$shipment->id.'" class="dropdown-item">Print</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status','account_id'])
        //->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getDeliveryException($category){
        if(Auth::guard('admin')->user()->station_id == '0'){
            //$shipment = shipment::where('status',9)->where('hold_status',0)->orderBy('id', 'DESC')->get();
            $i =DB::table('shipments');
            if ( $category != 'category' )
            {
                $i->where('shipments.delivery_exception_category', $category);
            }
            $i->where('shipments.status',9);
            $i->where('shipments.hold_status',0);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }
        else{
            $i =DB::table('shipments');
            if ( $category != 'category' )
            {
                $i->where('shipments.delivery_exception_category', $category);
            }
            $i->where([['shipments.from_station_id',Auth::guard('admin')->user()->station_id],
                    ['shipments.status','9']]);
            $i->orWhere([['shipments.to_station_id',Auth::guard('admin')->user()->station_id],
                    ['shipments.status','9']]);
            $i->where('shipments.hold_status',0);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
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
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function getTodayDelivery(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $today = date('Y-m-d');
            $i =DB::table('shipments');
            $i->where('shipments.delivery_reschedule',1);
            $i->where('shipments.delivery_reschedule_date',$today);
            $i->where('shipments.hold_status',0);
            $i->where('shipments.status','!=',8);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }
        else{
            $today = date('Y-m-d');
            $i =DB::table('shipments');
            $i->where([['shipments.from_station_id',Auth::guard('admin')->user()->station_id],['shipments.delivery_reschedule',1],['shipments.delivery_reschedule_date',$today]]);
            $i->orWhere([['shipments.to_station_id',Auth::guard('admin')->user()->station_id],['shipments.delivery_reschedule',1],['shipments.delivery_reschedule_date',$today]]);
            $i->where('shipments.hold_status',0);
            $i->where('shipments.status','!=',8);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->delivery_reschedule_date)) . '</p>
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
                $to_station = station::find($shipment->to_station_id);
                $from_station = station::find($shipment->from_station_id);
                if($shipment->status == 4){
                    $agent = agent::find($shipment->transit_in_id);
                    if(!empty($agent)){
                        return '<td>
                        <p>Transit In '.$from_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>
                        </td>';
                    }
                }
                elseif($shipment->status == 6){
                    $agent = agent::find($shipment->transit_out_id);
                    if(!empty($agent)){
                        return '<td>
                        <p>Transit Out '.$from_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>
                        </td>';
                    }
                }
                elseif($shipment->status == 13){
                    $agent = agent::find($shipment->package_at_station_id);
                    if(!empty($agent)){
                        return '<td>
                        <p>Package At Station '.$from_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>
                        </td>';
                    }
                }
                elseif($shipment->status == 11){
                    $agent = agent::find($shipment->transit_in_id1);
                    if(!empty($agent)){
                        return '<p>Transit In '.$to_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
                elseif($shipment->status == 12){
                    $agent = agent::find($shipment->transit_out_id1);
                    if(!empty($agent)){
                        return '<p>Transit Out '.$to_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
                elseif($shipment->status == 14){
                    $agent = agent::find($shipment->package_at_station_id1);
                    if(!empty($agent)){
                        return '<p>Package At Station '.$to_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
                elseif($shipment->status == 7){
                    $agent = agent::find($shipment->van_scan_id);
                    if(!empty($agent)){
                        return '
                        <p>In the Van for Delivery</p>
                        <p>Agent ID '.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                    else{
                        return '
                        <p>In the Van for Delivery</p>'
                       ;
                    }
                }
                elseif($shipment->status == 8){
                    $agent = agent::find($shipment->delivery_agent_id);
                    if(!empty($agent)){
                        return '
                        <p>Shipment delivered</p>
                        <p>Agent ID '.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                    else{
                        return '
                        <p>Shipment delivered</p>'
                       ;
                    }
                }
                elseif($shipment->status == 9){
                    $agent = agent::find($shipment->delivery_exception_id);
                    if(!empty($agent)){
                        return '
                        <p>Delivery Exception</p>
                        <p>' . $shipment->delivery_exception_category . '</p>
                        <p>' . $shipment->delivery_exception_remark . '</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                    else{
                        return '<td>
                        <p>Delivery Exception</p>
                        <p>' . $shipment->delivery_exception_category . '</p>
                        <p>' . $shipment->delivery_exception_remark . '</p>
                        </td>';
                    }
                }
                elseif($shipment->status == 10){
                    return '<td>
                    <p>Shipment Cancel</p>
                    <p>' . $shipment->cancel_remark . '</p>
                    </td>';
                }
            })
            ->addColumn('action', function ($shipment) {
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getFutureDelivery(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $today = date('Y-m-d');
            $i =DB::table('shipments');
            $i->where('shipments.delivery_reschedule',1);
            $i->where('shipments.delivery_reschedule_date','!=',$today);
            $i->where('shipments.hold_status',0);
            $i->where('shipments.status','!=',8);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }
        else{
            $today = date('Y-m-d');
            $i =DB::table('shipments');
            $i->where([['shipments.from_station_id',Auth::guard('admin')->user()->station_id],['shipments.delivery_reschedule',1],['shipments.delivery_reschedule_date','!=',$today]]);
            $i->orWhere([['shipments.to_station_id',Auth::guard('admin')->user()->station_id],['shipments.delivery_reschedule',1],['shipments.delivery_reschedule_date','!=',$today]]);
            $i->where('shipments.hold_status',0);
            $i->where('shipments.status','!=',8);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
            })
            ->addColumn('shipment_date', function ($shipment) {
                return '<td>
                <p>' . date("d-m-Y",strtotime($shipment->delivery_reschedule_date)) . '</p>
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
                $to_station = station::find($shipment->to_station_id);
                $from_station = station::find($shipment->from_station_id);
                
                if($shipment->status == 4){
                    $agent = agent::find($shipment->transit_in_id);
                    if(!empty($agent)){
                        return '<td>
                        <p>Transit In '.$from_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>
                        </td>';
                    }
                }
                elseif($shipment->status == 6){
                    $agent = agent::find($shipment->transit_out_id);
                    if(!empty($agent)){
                        return '<td>
                        <p>Transit Out '.$from_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>
                        </td>';
                    }
                }
                elseif($shipment->status == 13){
                    $agent = agent::find($shipment->package_at_station_id);
                    if(!empty($agent)){
                        return '<td>
                        <p>Package At Station '.$from_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>
                        </td>';
                    }
                }
                elseif($shipment->status == 11){
                    $agent = agent::find($shipment->transit_in_id1);
                    if(!empty($agent)){
                        return '<p>Transit In '.$to_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
                elseif($shipment->status == 12){
                    $agent = agent::find($shipment->transit_out_id1);
                    if(!empty($agent)){
                        return '<p>Transit Out '.$to_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
                elseif($shipment->status == 14){
                    $agent = agent::find($shipment->package_at_station_id1);
                    if(!empty($agent)){
                        return '<p>Package At Station '.$to_station->station.'</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
                elseif($shipment->status == 7){
                    $agent = agent::find($shipment->van_scan_id);
                    if(!empty($agent)){
                        return '
                        <p>In the Van for Delivery</p>
                        <p>Agent ID '.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                    else{
                        return '
                        <p>In the Van for Delivery</p>'
                       ;
                    }
                }
                elseif($shipment->status == 8){
                    $agent = agent::find($shipment->delivery_agent_id);
                    if(!empty($agent)){
                        return '
                        <p>Shipment delivered</p>
                        <p>Agent ID '.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                    else{
                        return '
                        <p>Shipment delivered</p>'
                       ;
                    }
                }
                elseif($shipment->status == 9){
                    $agent = agent::find($shipment->delivery_exception_id);
                    if(!empty($agent)){
                        return '
                        <p>Delivery Exception</p>
                        <p>' . $shipment->delivery_exception_category . '</p>
                        <p>' . $shipment->delivery_exception_remark . '</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                    else{
                        return '<td>
                        <p>Delivery Exception</p>
                        <p>' . $shipment->delivery_exception_category . '</p>
                        <p>' . $shipment->delivery_exception_remark . '</p>
                        </td>';
                    }
                }
                elseif($shipment->status == 10){
                    return '<td>
                    <p>Shipment Cancel</p>
                    <p>' . $shipment->cancel_remark . '</p>
                    </td>';
                }
            })
            ->addColumn('action', function ($shipment) {
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getCancelRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('status',10)->where('hold_status',0)->orderBy('id', 'DESC')->get();
        }
        else{
            // $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',10)->where('hold_status',0)->orderBy('id', 'DESC')->get();
            $shipment = DB::table('shipments')
            ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','10']])
            ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                    ['status','10']])
            ->where('hold_status',0)->orderBy('id', 'DESC')
            ->get();
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
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
            ->addColumn('status', function ($shipment) {
                if($shipment->status == 10){
                    return '<td><p>Shipment Cancel</p> <p>'.$shipment->cancel_remark.'</p></td>';
                }
                // elseif($shipment->status == 11){
                //     return '
                //     <p>Canceled</p>
                //     ';
                // }
            })
            ->addColumn('action', function ($shipment) {
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getHoldRequest(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::where('hold_status',1)->orderBy('id', 'DESC')->get();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->orWhere('to_station_id',Auth::guard('admin')->user()->station_id)->where('hold_status',1)->orderBy('id', 'DESC')->get();
        }


        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).'</td>';
            })
            ->addColumn('shipment_mode', function ($shipment) {
                $special_service='';
                if ($shipment->shipment_mode == 2) {
                    $special_service.='<p>Express</p>';
                } else {
                    $special_service.='<p>Standard</p>';
                }
                if ($shipment->special_service == 1) {
                    $special_service.='<p>Special Service</p>';
                    $special_service.='<p>'.$shipment->special_service_description.'</p>';
                }
                return $special_service;
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
                return '<td><p>Hold Shipment</p></td>';
            })
            ->addColumn('action', function ($shipment) {
                $output2='';
                if(Auth::guard('admin')->user()->role_id == 0){
                    if($shipment->sender_id != 0){
                        $output2.='<a class="dropdown-item" href="/admin/edit-shipment/'.$shipment->id.'">Edit Shipment</a>';
                    }
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                        '.$output2.' 
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function revenueException(){
        $revenue_exception = revenue_exception_log::all();
        $language = language::all();
        return view('admin.revenue_exception',compact('revenue_exception','language'));
    }

    public function getRevenueException(){
        //if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = revenue_exception_log::orderBy('id', 'DESC')->get();
        // }
        // else{
        //     $revenue_exception_log = revenue_exception_log::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',10)->orderBy('id', 'DESC')->get();
        // }

        return Datatables::of($shipment)
            ->addColumn('track_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->shipment_id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('old_weight', function ($shipment) {
                return '<td>'.$shipment->old_weight.'</td>';
            })
            ->addColumn('old_dimension', function ($shipment) {
                return '<td>'.$shipment->old_length.' * '.$shipment->old_width.' * '.$shipment->old_height.'</td>';
            })
            ->addColumn('weight', function ($shipment) {
                return '<td>'.$shipment->weight.'</td>';
            })
            ->addColumn('dimension', function ($shipment) {
                return '<td>'.$shipment->length.' * '.$shipment->width.' * '.$shipment->height.'</td>';
            })
           
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>   
                    </div>
                </td>';
            })
            
        ->rawColumns(['track_id','old_weight','old_dimension','weight','dimension','action'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



}
