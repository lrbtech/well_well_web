<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\drop_point;
use App\Models\country;
use App\Models\city;
use App\Models\shipment_category;
use App\Models\agent_settlement;
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
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Mail;
use PDF;
use App\Exports\ShipmentExport;
use App\Exports\RevenueExport;
use App\Exports\AgentExport;
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

    public function PaymentsOutReport(){
        $user = User::where('status',4)->get();
        $language = language::all();
        return view('admin.payments_out',compact('user','language'));
    }


    public function getPaymentsInReport($agent_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
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
        $i->where('s.status', 8);
        $i->groupBy('s.delivery_agent_id');
        $i->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("SUM(s.special_cod) as special_cod") , DB::raw("SUM(s.collect_cod_amount) as collect_cod_amount") , DB::raw("s.delivery_agent_id") ]);
        $shipment = $i->get();

        return Datatables::of($shipment)
            ->addColumn('agent_details', function ($shipment) {
                $agent = agent::find($shipment->delivery_agent_id);
                return '<td>
                <p>Agent Id : '.$agent->agent_id.'</p>
                <p>Name : '.$agent->name.'</p>
                </td>';
            })
            ->addColumn('no_of_shipments', function ($shipment) {
                return '<td>
                <p>'.$shipment->no_of_shipments.'</p>
                </td>';
            })

            ->addColumn('total_value', function ($shipment) {
                return '<td>
                <p>AED ' . $shipment->special_cod . '</p>
                </td>';
            })

            ->addColumn('collected_value', function ($shipment) {
                return '<td>
                <p>AED ' . $shipment->collect_cod_amount . '</p>
                </td>';
            })

            ->addColumn('settlement_value', function ($shipment) {
                $agent = agent::find($shipment->delivery_agent_id);
                return '<td>
                <p>AED ' . $agent->settle_payment . '</p>
                </td>';
            })
            
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <p><a onclick="Settlement('.$shipment->delivery_agent_id.')" href="#" >Settlement Value</a></p>
                </td>';
            })
            
        ->rawColumns(['agent_details','no_of_shipments', 'total_value', 'collected_value','settlement_value','action'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getPaymentsOutReport($user_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
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
        $i->groupBy('s.sender_id');
        $i->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("SUM(s.special_cod) as special_cod") , DB::raw("SUM(s.cod_amount) as admin_fees") , DB::raw("s.sender_id") ]);
        $shipment = $i->get();

        return Datatables::of($shipment)
            ->addColumn('user_details', function ($shipment) {
                $user = User::find($shipment->sender_id);
                return '<td>
                <p>Customer Id : '.$user->customer_id.'</p>
                <p>Name : '.$user->first_name.' '.$user->last_name.'</p>
                </td>';
            })
            ->addColumn('no_of_shipments', function ($shipment) {
                return '<td>
                <p>'.$shipment->no_of_shipments.'</p>
                </td>';
            })

            ->addColumn('total_value', function ($shipment) {
                return '<td>
                <p>AED ' . $shipment->special_cod . '</p>
                </td>';
            })

            ->addColumn('admin_fees', function ($shipment) {
                return '<td>
                <p>AED ' . $shipment->admin_fees . '</p>
                </td>';
            })

            ->addColumn('payable_value', function ($shipment) {
                $settlement = $shipment->special_cod - $shipment->admin_fees;
                return '<td>
                <p>AED ' . $settlement . '</p>
                </td>';
            })

            ->addColumn('settlement_value', function ($shipment) {
                $user = User::find($shipment->sender_id);
                return '<td>
                <p>AED ' . $user->paid . '</p>
                </td>';
            })
            
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <p><a onclick="Settlement('.$shipment->sender_id.')" href="#" >Settlement Value</a></p>
                </td>';
            })
            
        ->rawColumns(['user_details','no_of_shipments', 'total_value', 'admin_fees','settlement_value','payable_value','action'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function agentSettlement(Request $request){
        $this->validate($request, [
            'settlement_value'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'image.required' => 'Upload Slip Field is Required',
        ]);
        
        $agent_settlement = new agent_settlement;
        $agent_settlement->amount = $request->settlement_value;
        $agent_settlement->agent_id = $request->delivery_agent_id;

        $agent = agent::find($request->delivery_agent_id);
        $agent->settle_payment = $agent->settle_payment + $request->settlement_value;
        $agent->balance_payment = $agent->total_payment - ($agent->settle_payment + $request->settlement_value);
        $agent->save();

        if($request->image!=""){
            if($request->file('image')!=""){
            $image = $request->file('image');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_slip/'), $upload_image);
            $agent_settlement->image = $upload_image;
            }
        }
        $agent_settlement->save();
        return response()->json('successfully update'); 
    }


    public function userSettlement(Request $request){
        $this->validate($request, [
            'settlement_value'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'image.required' => 'Upload Slip Field is Required',
        ]);
        
        $user_settlement = new user_settlement;
        $user_settlement->amount = $request->settlement_value;
        $user_settlement->user_id = $request->sender_id;

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
        return response()->json('successfully update');     
    }

}
