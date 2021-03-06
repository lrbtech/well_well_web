<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\drop_point;
use App\Models\country;
use App\Models\city;
use App\Models\shipment_category;
use App\Models\agent_settlement;
use App\Models\accounts_settlement;
use App\Models\user_settlement;
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
use App\Models\language;
use App\Models\role;
use App\Models\admin;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Mail;
use PDF;
use App\Exports\ShipmentExport;
use App\Exports\RevenueExport;
use App\Exports\AgentExport;
use App\Exports\UserSettlementExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Admin\logController;

class SettlementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }


    public function PaymentsInReport(){
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
        return view('admin.payments_in',compact('agent','language'));
    }

    public function CourierTeamGuestSettlement(){
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
        return view('admin.courier_guest_settlement',compact('agent','language'));
    }

    public function CourierTeamCOPSettlement(){
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
        return view('admin.agent_cop_settlement',compact('agent','language'));
    }

    public function PaymentsOutReport(){
        $user = User::where('status',4)->get();
        $language = language::all();
        return view('admin.payments_out',compact('user','language'));
    }

    public function AccountsTeamReport(){
        $language = language::all();
        return view('admin.accounts_team_report',compact('language'));
    }

    // public function viewAgentSettlement($id){
    //     $user = admin::all();
    //     $language = language::all();
    //     $agent_settlement = agent_settlement::where('agent_id',$id)->get();
    //     return view('admin.agent_settlement',compact('user','language','agent_settlement'));
    // }

    public function viewUserSettlement(){
        $user = User::where('status',4)->get();
        $language = language::all();
        return view('admin.user_settlement',compact('user','language'));
    }

    public function viewAgentSettlement(){
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
        return view('admin.agent_settlement',compact('agent','language'));
    }

    public function viewAccountsSettlement($id){
        $user = admin::all();
        $language = language::all();
        $accounts_settlement = accounts_settlement::where('admin_id',$id)->get();
        return view('admin.accounts_settlement',compact('user','language','accounts_settlement'));
    }


    public function getPaymentsInReport($agent_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));

        if ( $agent_id != 'agent'){
            $i =DB::table('shipments as s');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('s.delivery_date', [$fdate1, $tdate1]);
            }
            if ( $agent_id != 'agent' )
            {
                $i->where('s.delivery_agent_id', $agent_id);
            }
            $i->where('s.special_cod_enable', 1);
            $i->where('s.paid_agent_status', 0);
            $i->where('s.status', 8);
            $shipment = $i->get();
        }
        else{
            $shipment = array();
        }

        return Datatables::of($shipment)
        ->addColumn('order_id', function ($shipment) {
            $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
            return '<td>'.$shipment_package[0]->sku_value.'</td>';
        })
        ->addColumn('checkbox', function ($shipment) {
            $today = date('Y-m-d');
            return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
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
            $user = User::find($shipment->sender_id);
            if(!empty($from_area)){
            return '<td>
            <p><b>Mobile :' . $from_address->contact_mobile . '</b></p>
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
            <p><b>Mobile :' . $to_address->contact_mobile . '</b></p>
            <p>' . $to_area->city . '</p>
            <p>' . $to_city->city . '</p>
            <p><b>Station :' . $to_station->station . '</b></p>
            </td>';
            }
            else{
                return '<td></td>';
            }
        })
        ->addColumn('collected_value', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->collect_cod_amount . '</p>
            </td>';
        })
        ->addColumn('special_cod', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->special_cod . '</p>
            </td>';
        })
        
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_mode','collected_value','special_cod','checkbox'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getCourierTeamCOPSettlement($agent_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));

        if ( $agent_id != 'agent'){
            $i =DB::table('shipments as s');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('s.package_collect_date', [$fdate1, $tdate1]);
            }
            if ( $agent_id != 'agent' )
            {
                $i->where('s.package_collect_agent_id', $agent_id);
            }
            $i->where('s.collect_cop_amount','!=','');
            $i->where('s.paid_agent_cop_status', 0);
            $i->where('s.sender_id','!=',0);
            $shipment = $i->get();
        }
        else{
            $shipment = array();
        }

        return Datatables::of($shipment)
        ->addColumn('order_id', function ($shipment) {
            $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
            return '<td>'.$shipment_package[0]->sku_value.'</td>';
        })
        ->addColumn('checkbox', function ($shipment) {
            $today = date('Y-m-d');
            return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
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
            $user = User::find($shipment->sender_id);
            if(!empty($from_area)){
            return '<td>
            <p><b>Mobile :' . $from_address->contact_mobile . '</b></p>
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
            <p><b>Mobile :' . $to_address->contact_mobile . '</b></p>
            <p>' . $to_area->city . '</p>
            <p>' . $to_city->city . '</p>
            <p><b>Station :' . $to_station->station . '</b></p>
            </td>';
            }
            else{
                return '<td></td>';
            }
        })
        ->addColumn('collected_value', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->collect_cod_amount . '</p>
            </td>';
        })
        ->addColumn('special_cod', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->special_cod . '</p>
            </td>';
        })
        
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_mode','collected_value','special_cod','checkbox'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getCourierTeamGuestSettlement($agent_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));

        if ( $agent_id != 'agent'){
            $i =DB::table('shipments as s');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('s.package_collect_date', [$fdate1, $tdate1]);
            }
            if ( $agent_id != 'agent' )
            {
                $i->where('s.package_collect_agent_id', $agent_id);
            }
            $i->where('s.collect_cod_amount','!=','');
            $i->where('s.paid_agent_status', 0);
            $i->where('s.sender_id',0);
            $shipment = $i->get();
        }
        else{
            $shipment = array();
        }

        return Datatables::of($shipment)
        ->addColumn('order_id', function ($shipment) {
            $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
            return '<td>'.$shipment_package[0]->sku_value.'</td>';
        })
        ->addColumn('checkbox', function ($shipment) {
            $today = date('Y-m-d');
            return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
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
            $user = User::find($shipment->sender_id);
            if(!empty($from_area)){
            return '<td>
            <p><b>Mobile :' . $from_address->contact_mobile . '</b></p>
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
            <p><b>Mobile :' . $to_address->contact_mobile . '</b></p>
            <p>' . $to_area->city . '</p>
            <p>' . $to_city->city . '</p>
            <p><b>Station :' . $to_station->station . '</b></p>
            </td>';
            }
            else{
                return '<td></td>';
            }
        })
        ->addColumn('collected_value', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->collect_cod_amount . '</p>
            </td>';
        })
        ->addColumn('special_cod', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->special_cod . '</p>
            </td>';
        })
        
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_mode','collected_value','special_cod','checkbox'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getPaymentsOutReport($user_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        if ( $user_id != 'user'){
            $i =DB::table('shipments as s');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('s.delivery_date', [$fdate1, $tdate1]);
            }
            if ( $user_id != 'user' )
            {
                $i->where('s.sender_id', $user_id);
            }

            $i->where('s.sender_id','!=', 0);
            $i->where('s.special_cod_enable', 1);
            $i->where('s.status', 8);
            $i->where('s.paid_status', 0);
            $shipment = $i->get();
        }
        else{
            $shipment = array();
        }

        return Datatables::of($shipment)
        ->addColumn('order_id', function ($shipment) {
            $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
            return '<td>'.$shipment_package[0]->sku_value.'</td>';
        })
        ->addColumn('checkbox', function ($shipment) {
            $today = date('Y-m-d');
            return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $shipment->id . '"></td>';
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
            <p>' . date("d-m-Y",strtotime($shipment->date)) . '</p>
            </td>';
        })

        ->addColumn('from_address', function ($shipment) {
            $from_address = manage_address::find($shipment->from_address);
            $from_city = city::find($from_address->city_id);
            $from_area = city::find($from_address->area_id);
            $from_station = station::find($shipment->from_station_id);
            $user = User::find($shipment->sender_id);
            if(!empty($from_area)){
            return '<td>
            <p><b>Mobile :' . $from_address->contact_mobile . '</b></p>
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
            <p><b>Mobile :' . $to_address->contact_mobile . '</b></p>
            <p>' . $to_area->city . '</p>
            <p>' . $to_city->city . '</p>
            <p><b>Station :' . $to_station->station . '</b></p>
            </td>';
            }
            else{
                return '<td></td>';
            }
        })
        ->addColumn('total', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->total . '</p>
            </td>';
        })
        ->addColumn('special_cod', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->special_cod . '</p>
            </td>';
        })
        
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_mode','total','special_cod','checkbox'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function getViewUserSettlement($user_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        if ( $user_id != 'user'){
            $i =DB::table('user_settlements as s');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('s.date', [$fdate1, $tdate1]);
            }
            if ( $user_id != 'user' )
            {
                $i->where('s.user_id', $user_id);
            }
            $shipment = $i->get();
        }
        else{
            $shipment = array();
        }

        return Datatables::of($shipment)
        ->addColumn('date', function ($shipment) {
            return '<td>
            <p>' . date("d-m-Y",strtotime($shipment->date)) . '</p>
            </td>';
        })

        ->addColumn('amount', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->amount . '</p>
            </td>';
        })
        ->addColumn('slip', function ($shipment) {
            return '<td>
            <img style="width: 100px;height: 100px;" src="/upload_slip/'.$shipment->image.'">
            <br>
            <a class="btn btn-shadow-primary" href="/upload_slip/'.$shipment->image.'" download>Download</a>
            </td>';
        })

        ->addColumn('admin', function ($shipment) {
            $admin = admin::find($shipment->admin_id);
            return '<td>
            <p>' . $admin->name . '</p>
            </td>';
        })
        ->addColumn('no_of_shipments', function ($shipment) {
            return '<td>
            <p>' . $shipment->no_of_shipments . '</p>
            </td>';
        })
        ->rawColumns(['date','amount','slip','admin','no_of_shipments'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function agentSettlement(Request $request){
        $this->validate($request, [
            'amount'=>'required',
            'date'=>'required',
            'mode'=>'required',
            //'image' => 'required|mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            //'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            //'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            //'image.required' => 'Upload Slip Field is Required',
        ]);

        $agent_settlement = new agent_settlement;
        $agent_settlement->date = date('Y-m-d',strtotime($request->date));
        $agent_settlement->amount = $request->amount;
        $agent_settlement->mode = $request->mode;
        $agent_settlement->agent_id = $request->delivery_agent_id;
        $agent_settlement->receiver_id = Auth::guard('admin')->user()->id;
        $agent_settlement->no_of_shipments = $request->no_of_shipments;
        $agent_settlement->shipment_ids = $request->shipment_ids;
        $agent_settlement->save();
        
        if($request->mode == '1'){
            $agent = agent::find($request->delivery_agent_id);
            $agent->paid_cod = $agent->paid_cod + $request->amount;
            $agent->save();

            $admin = admin::find(Auth::guard('admin')->user()->id);
            $admin->total_cod = $admin->total_cod + $request->amount;
            $admin->save();
        }
        if($request->mode == '2'){
            $agent = agent::find($request->delivery_agent_id);
            $agent->paid_guest = $agent->paid_guest + $request->amount;
            $agent->save();

            $admin = admin::find(Auth::guard('admin')->user()->id);
            $admin->total_guest = $admin->total_guest + $request->amount;
            $admin->save();
        }
        if($request->mode == '3'){
            $agent = agent::find($request->delivery_agent_id);
            $agent->paid_cop = $agent->paid_cop + $request->amount;
            $agent->save();

            $admin = admin::find(Auth::guard('admin')->user()->id);
            $admin->total_cop = $admin->total_cop + $request->amount;
            $admin->save();
        }

        $arraydata=array();
        foreach(explode(',',$request->shipment_ids) as $user1){
            $arraydata[]=$user1;
        }
       
        $shipments = shipment::whereIn('id', $arraydata)->get();
        foreach ($shipments as $row) {
            $shipment = shipment::find($row->id);
            $shipment->paid_agent_status = 1;
            $shipment->paid_agent_date = date('Y-m-d');
            $shipment->save();
        }

        return response()->json('successfully update'); 
    }


    public function accountsSettlement(Request $request){
        $this->validate($request, [
            'amount'=>'required',
            'date'=>'required',
            'mode'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'image.required' => 'Upload Slip Field is Required',
        ]);
        
        if($request->mode == '1'){
            $accounts_settlement = new accounts_settlement;
            $accounts_settlement->date = date('Y-m-d',strtotime($request->date));
            $accounts_settlement->amount = $request->amount;
            $accounts_settlement->mode = $request->mode;
            $accounts_settlement->admin_id = Auth::guard('admin')->user()->id;

            $admin = admin::find(Auth::guard('admin')->user()->id);
            $admin->paid_cod = $admin->paid_cod + $request->amount;
            $admin->save();

            if($request->image!=""){
                if($request->file('image')!=""){
                $image = $request->file('image');
                $upload_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload_slip/'), $upload_image);
                $accounts_settlement->image = $upload_image;
                }
            }
            $accounts_settlement->save();
        }

        if($request->mode == '2'){
            $accounts_settlement = new accounts_settlement;
            $accounts_settlement->date = date('Y-m-d',strtotime($request->date));
            $accounts_settlement->amount = $request->amount;
            $accounts_settlement->mode = $request->mode;
            $accounts_settlement->admin_id = Auth::guard('admin')->user()->id;

            $admin = admin::find(Auth::guard('admin')->user()->id);
            $admin->paid_guest = $admin->paid_guest + $request->amount;
            $admin->save();

            if($request->image!=""){
                if($request->file('image')!=""){
                $image = $request->file('image');
                $upload_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload_slip/'), $upload_image);
                $accounts_settlement->image = $upload_image;
                }
            }
            $accounts_settlement->save();
        }

        if($request->mode == '3'){
            $accounts_settlement = new accounts_settlement;
            $accounts_settlement->date = date('Y-m-d',strtotime($request->date));
            $accounts_settlement->amount = $request->amount;
            $accounts_settlement->mode = $request->mode;
            $accounts_settlement->admin_id = Auth::guard('admin')->user()->id;

            $admin = admin::find(Auth::guard('admin')->user()->id);
            $admin->paid_cop = $admin->paid_cop + $request->amount;
            $admin->save();

            if($request->image!=""){
                if($request->file('image')!=""){
                $image = $request->file('image');
                $upload_image = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload_slip/'), $upload_image);
                $accounts_settlement->image = $upload_image;
                }
            }
            $accounts_settlement->save();
        }
        
        return response()->json('successfully update'); 
    }



    public function getUserSettlement(Request $request)
    {
        $data = shipment::whereIn('id', $request->id)->get();
        $total_value=0;
        $no_of_shipments=0;
        $sender_id;
        foreach ($data as $row) {
            $shipment = shipment::find($row->id);
            $total_value = $total_value + $shipment->special_cod;
            $sender_id = $shipment->sender_id;
            $no_of_shipments++;
        }

        $datas = array(
            'no_of_shipments' => $no_of_shipments,
            'total_value' => $total_value,
            'sender_id' => $sender_id,
            'shipment_ids' => $request->id,
        );
        return response()->json($datas);
    }

    public function getAgentSettlement(Request $request)
    {
        $data = shipment::whereIn('id', $request->id)->get();
        $total_value=0;
        $no_of_shipments=0;
        $delivery_agent_id;
        foreach ($data as $row) {
            $shipment = shipment::find($row->id);
            if($request->mode == 1){
                $delivery_agent_id = $shipment->delivery_agent_id;
                $total_value = $total_value + $shipment->collect_cod_amount;
            }
            elseif($request->mode == 2){
                $delivery_agent_id = $shipment->package_collect_agent_id;
                $total_value = $total_value + $shipment->collect_cod_amount;
            }
            elseif($request->mode == 3){
                $delivery_agent_id = $shipment->package_collect_agent_id;
                $total_value = $total_value + $shipment->collect_cop_amount;
            }
            $no_of_shipments++;
        }

        $datas = array(
            'no_of_shipments' => $no_of_shipments,
            'total_value' => $total_value,
            'delivery_agent_id' => $delivery_agent_id,
            'shipment_ids' => $request->id,
        );
        return response()->json($datas);
    }


    public function userSettlement(Request $request){
        $this->validate($request, [
            'settlement_value'=>'required',
            'date'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'image.required' => 'Upload Slip Field is Required',
        ]);
        
        $user_settlement = new user_settlement;
        $user_settlement->date = date('Y-m-d',strtotime($request->date));
        $user_settlement->amount = $request->settlement_value;
        $user_settlement->user_id = $request->sender_id;
        $user_settlement->admin_id = Auth::guard('admin')->user()->id;
        $user_settlement->no_of_shipments = $request->no_of_shipments;
        $user_settlement->shipment_ids = $request->shipment_ids;

        $user = User::find($request->sender_id);
        $user->paid = $user->paid + $request->settlement_value;
        $user->balance = $user->total - ($user->paid + $request->settlement_value);
        $user->save();
        if($request->image!=""){
            $image = $request->file('image');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_slip/'), $upload_image);
            $user_settlement->image = $upload_image;
        }
        $user_settlement->save();

        $arraydata=array();
        foreach(explode(',',$request->shipment_ids) as $user1){
            $arraydata[]=$user1;
        }
       
        $shipments = shipment::whereIn('id', $arraydata)->get();
        foreach ($shipments as $row) {
            $shipment = shipment::find($row->id);
            $shipment->paid_status = 1;
            $shipment->paid_date = date('Y-m-d');
            $shipment->save();
        }
        return response()->json('successfully update');     
    }


    public function getAccountsTeamReport(){
        
        $i =DB::table('admins');
        $i->where('id', Auth::guard('admin')->user()->id);
        $admin = $i->get();

        return Datatables::of($admin)
            ->addColumn('admin_details', function ($admin) {
                return '<td>
                <p>Employee Id : '.$admin->employee_id.'</p>
                <p>Name : '.$admin->name.'</p>
                </td>';
            })

            ->addColumn('collect_amount', function ($admin) {
                return '<td>
                <p>COD Payment : ' . $admin->total_cod . ' AED</p>
                <p>COP Payment : ' . $admin->total_cop . ' AED</p>
                <p>Guest Payment : ' . $admin->total_guest . ' AED</p>
                </td>';
            })

            ->addColumn('paid', function ($admin) {
                return '<td>
                <p>COD Payment : ' . $admin->paid_cod . ' AED</p>
                <p>COP Payment : ' . $admin->paid_cop . ' AED</p>
                <p>Guest Payment : ' . $admin->paid_guest . ' AED</p>
                </td>';
            })

            ->addColumn('balance', function ($admin) {
                return '<td>
                <p>COD Payment : ' . ($admin->total_cod - $admin->paid_cod) . ' AED</p>
                <p>COP Payment : ' . ($admin->total_cop - $admin->paid_cop) . ' AED</p>
                <p>Guest Payment : ' . ($admin->total_guest - $admin->paid_guest) . ' AED</p>
                </td>';
            })

            
            ->addColumn('action', function ($admin) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" onclick="Settlement('.$admin->id.')" href="#" >Settlement Value</a>
                        <a class="dropdown-item" href="/admin/view-accounts-settlement/'.$admin->id.'">View Details</a>    
                    </div>
                </td>';
            })
            
        ->rawColumns(['admin_details','collect_amount', 'paid', 'balance','action'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getViewAgentSettlement($agent_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        if ( $agent_id != 'agent'){
            $i =DB::table('agent_settlements as s');
            if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
            {
                $i->whereBetween('s.date', [$fdate1, $tdate1]);
            }
            if ( $agent_id != 'agent' )
            {
                $i->where('s.agent_id', $agent_id);
            }
            $shipment = $i->get();
        }
        else{
            $shipment = array();
        }

        return Datatables::of($shipment)
        ->addColumn('date', function ($shipment) {
            return '<td>
            <p>' . date("d-m-Y",strtotime($shipment->date)) . '</p>
            </td>';
        })

        ->addColumn('amount', function ($shipment) {
            return '<td>
            <p>AED ' . $shipment->amount . '</p>
            </td>';
        })

        ->addColumn('no_of_shipments', function ($shipment) {
            return '<td>
            <p>' . $shipment->no_of_shipments . '</p>
            </td>';
        })

        ->addColumn('admin', function ($shipment) {
            $admin = admin::find($shipment->receiver_id);
            return '<td>
            <p>' . $admin->name . '</p>
            </td>';
        })

        ->addColumn('mode', function ($shipment) {
            if($shipment->mode == 1){
                return '<td>C.O.D</td>';
            }
            elseif($shipment->mode == 2){
                return '<td>Guest</td>';
            }
            elseif($shipment->mode == 3){
                return '<td>C.O.P</td>';
            }
        })
        
        ->rawColumns(['date','amount','admin','mode','no_of_shipments'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



    public function printAgentSettlement(Request $request){
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));
        if ( $request->agent_id != 'agent'){
            $i =DB::table('agent_settlements as s');
            if ( $fdate != '1970-01-01' && $tdate != '1970-01-01' )
            {
                $i->whereBetween('s.date', [$fdate, $tdate]);
            }
            if ( $request->agent_id != 'agent' )
            {
                $i->where('s.agent_id', $request->agent_id);
            }
            $shipment = $i->get();
        }
        else{
            $shipment = array();
        }

        $admin = admin::all();
        $pdf = PDF::loadView('print.print_agent_settlement',compact('shipment','fdate','tdate','admin'));
        $pdf->setPaper('A4');
        return $pdf->stream('print_agent_settlement.pdf');

    }

    public function printUserSettlement(Request $request){
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));
        if ( $request->user_id != 'user'){
            $i =DB::table('user_settlements as s');
            if ( $fdate != '1970-01-01' && $tdate != '1970-01-01' )
            {
                $i->whereBetween('s.date', [$fdate, $tdate]);
            }
            if ( $request->user_id != 'user' )
            {
                $i->where('s.user_id', $request->user_id);
            }
            $shipment = $i->get();
        }
        else{
            $shipment = array();
        }

        $admin = admin::all();


        $pdf = PDF::loadView('print.print_user_settlement',compact('shipment','fdate','tdate','admin'));
        $pdf->setPaper('A4');
        return $pdf->stream('print_user_settlement.pdf');

    }

    public static function printAccountsSettlementAdminDetails($id){
        $admin = admin::find($id);
        return '
        '. $admin->employee_id .'
        '. $admin->name .'
        ';
    }

    public function printAccountsSettlement(Request $request){
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));
        $i =DB::table('accounts_settlements as s');
        if ( $fdate != '1970-01-01' && $tdate != '1970-01-01' )
        {
            $i->whereBetween('s.date', [$fdate, $tdate]);
        }
        $shipment = $i->get();

        $admin = admin::all();

        $pdf = PDF::loadView('print.print_accounts_team_settlement',compact('shipment','fdate','tdate','admin'));
        $pdf->setPaper('A4');
        return $pdf->stream('print_accounts_team_settlement.pdf');

    }

    public function excelUserSettlement($user_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        return Excel::download(new UserSettlementExport($user_id,$fdate1,$tdate1), 'UserSettlementExport.xlsx');
        //return (new BookingExport($fdate,$tdate))->download('report.xlsx');
    }



}
