<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\drop_point;
use App\Models\country;
use App\Models\city;
use App\Models\shipment_category;
use App\Models\agent_settlement;
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

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function BoxReport(){
        $today = date('Y-m-d');
        $cfdate = date('Y-m-d',strtotime('first day of this month'));
        $cldate = date('Y-m-d',strtotime('last day of this month'));
        $language = language::all();
        $user = User::where('status',4)->get();

        $total_shipment = shipment::whereBetween('date', [$cfdate, $cldate])->count();
        $special_cod = shipment::whereBetween('date', [$cfdate, $cldate])->get()->sum("special_cod");
        $collect_cod_amount = shipment::whereBetween('date', [$cfdate, $cldate])->get()->sum("collect_cod_amount");
        $pickup_exception = shipment::whereBetween('date', [$cfdate, $cldate])->where('status',3)->count();
        $delivery_exception = shipment::whereBetween('date', [$cfdate, $cldate])->where('status',9)->count();
        $shipment_delivered = shipment::whereBetween('date', [$cfdate, $cldate])->where('status',8)->count();

        $old_user_type = 'all_user';

        return view('admin.box_report',compact('total_shipment','special_cod','language','collect_cod_amount','cfdate','cldate','pickup_exception','delivery_exception','shipment_delivered','user','old_user_type'));
    }

    public function SearchBoxReport(Request $request){
        $today = date('Y-m-d');
        $cfdate = date('Y-m-d', strtotime($request->from_date));
        $cldate = date('Y-m-d', strtotime($request->to_date));
        $language = language::all();
        $user = User::where('status',4)->get();

        if ( $request->user_type != 'all_user' && $request->from_date != '1970-01-01' && $request->to_date != '1970-01-01'){
            $total_shipment = shipment::whereBetween('date', [$cfdate, $cldate])->where('sender_id',$request->user_type)->count();
            $special_cod = shipment::whereBetween('date', [$cfdate, $cldate])->where('sender_id',$request->user_type)->get()->sum("special_cod");
            $collect_cod_amount = shipment::whereBetween('date', [$cfdate, $cldate])->where('sender_id',$request->user_type)->get()->sum("collect_cod_amount");
            $pickup_exception = shipment::whereBetween('date', [$cfdate, $cldate])->where('sender_id',$request->user_type)->where('status',3)->count();
            $delivery_exception = shipment::whereBetween('date', [$cfdate, $cldate])->where('sender_id',$request->user_type)->where('status',9)->count();
            $shipment_delivered = shipment::whereBetween('date', [$cfdate, $cldate])->where('sender_id',$request->user_type)->where('status',8)->count();
        }
        else{
            $total_shipment = shipment::whereBetween('date', [$cfdate, $cldate])->count();
            $special_cod = shipment::whereBetween('date', [$cfdate, $cldate])->get()->sum("special_cod");
            $collect_cod_amount = shipment::whereBetween('date', [$cfdate, $cldate])->get()->sum("collect_cod_amount");
            $pickup_exception = shipment::whereBetween('date', [$cfdate, $cldate])->where('status',3)->count();
            $delivery_exception = shipment::whereBetween('date', [$cfdate, $cldate])->where('status',9)->count();
            $shipment_delivered = shipment::whereBetween('date', [$cfdate, $cldate])->where('status',8)->count();
        }

        $old_user_type = $request->user_type;

        return view('admin.box_report',compact('total_shipment','special_cod','language','collect_cod_amount','cfdate','cldate','pickup_exception','delivery_exception','shipment_delivered','user','old_user_type'));
    }


    public function ShipmentReport(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $agent = agent::where('status',0)->get();
        }
        else{
            $q =DB::table('agents as a');
            $q->join('cities as c','a.city_id','=','c.id');
            $q->where('c.station_id', Auth::guard('admin')->user()->station_id);
            $q->where('a.status',0);
            $q->select('a.*');
            $agent = $q->get();
        }
        $language = language::all();
        $user = User::where('status',4)->get();
        return view('admin.shipment_report',compact('agent','language','user'));
    }

    public function AgentReport(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $agent = agent::where('status',0)->get();
        }
        else{
            $q =DB::table('agents as a');
            $q->join('cities as c','a.city_id','=','c.id');
            $q->where('c.station_id', Auth::guard('admin')->user()->station_id);
            $q->where('a.status',0);
            $q->select('a.*');
            $agent = $q->get();
        }
        $language = language::all();
        return view('admin.agent_report',compact('agent','language'));
    }


    public function getShipmentReport($status,$user_type,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i = DB::table('shipments');
        if ( $user_type != 'all_user' )
        {
            if ( $user_type != 'guest' ){
                $i->where('shipments.sender_id', $user_type);
                //$i->join('users', 'users.id', '=', 'shipments.sender_id');
            }
            else{
                $i->where('shipments.sender_id', 0);
            }
        }
        if ( $status != 20 )
        {
            if ( $status == 4 ){
                $i->where('shipments.status', 4);
                $i->orWhere('shipments.status', 11);
            }
            elseif ( $status == 6 ){
                $i->where('shipments.status', 6);
                $i->orWhere('shipments.status', 12);
            }
            else{
                $i->where('shipments.status', $status);
            }
        }
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('shipments.date', [$fdate1, $tdate1]);
        }

        $i->where('shipments.show_status',0);
        $i->orderBy('shipments.id','DESC');
        $shipment = $i->latest();

        return Datatables::collection($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('reference_no', function ($shipment) {
                return '<td>'.$shipment->reference_no.'</td>';
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
            ->addColumn('status', function ($shipment) {
                $to_station = station::find($shipment->to_station_id);
                $from_station = station::find($shipment->from_station_id);
                if($shipment->status == 0){
                    return 'Ready for Pickup';
                }
                elseif($shipment->status == 1){
                    $agent = agent::find($shipment->pickup_agent_id);
                    if(!empty($agent)){
                        return 'Schedule for Pickup '.$agent->agent_id;
                    }
                    else{
                        return 'Schedule for Pickup';
                    }
                }
                elseif($shipment->status == 2){
                    $agent = agent::find($shipment->pickup_agent_id);
                    if(!empty($agent)){
                        return 'Package Collected '.$agent->agent_id;
                    }
                    else{
                        return 'Package Collected';
                    }
                }
                elseif($shipment->status == 3){
                    return '<td>
                    <p>Pickup Exception</p>
                    <p>' . $shipment->exception_category . '</p>
                    <p>' . $shipment->exception_remark . '</p>
                    </td>';
                }
                elseif($shipment->status == 4){
                    return '<p>Transit In '.$from_station->station.'</p>';
                }
                elseif($shipment->status == 6){
                    return '<p>Transit Out '.$from_station->station.'</p>';
                }
                elseif($shipment->status == 11){
                    return '<p>Transit In '.$to_station->station.'</p>';
                }
                elseif($shipment->status == 12){
                    return '<p>Transit Out '.$to_station->station.'</p>';
                }
                elseif($shipment->status == 7){
                    $agent = agent::find($shipment->delivery_agent_id);
                    if(!empty($agent)){
                        return '
                        <p>In the Van for Delivery</p>
                        <p>Agent ID '.$agent->agent_id.'</p>'
                       ;
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
                        <p>Agent ID '.$agent->agent_id.'</p>'
                       ;
                    }
                    else{
                        return '
                        <p>Shipment delivered</p>'
                       ;
                    }
                }
                elseif($shipment->status == 9){
                    return '<td>
                    <p>Delivery Exception</p>
                    <p>' . $shipment->delivery_exception_category . '</p>
                    <p>' . $shipment->delivery_exception_remark . '</p>
                    </td>';
                }
                elseif($shipment->status == 10){
                    return '<td>
                    <p>Shipment Cancel</p>
                    <p>' . $shipment->cancel_remark . '</p>
                    </td>';
                }
                elseif($shipment->status == 15){
                    $agent = agent::find($shipment->return_shipment_id);
                    if(!empty($agent)){
                        return '<p>Return to Shipper</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>';
                    }
                }
            })
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a  class="dropdown-item" target="_blank" href="/admin/print-invoice/'.$shipment->id.'" >Print</a>  
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_mode','action','total','status','account_id','special_cod','reference_no'])
        ->addIndexColumn()
        ->toJson();
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function excelShipmentReport(Request $request){
        // $request->validate([
        //     'from_date'=>'required',
        //     'to_date'=>'required',
        // ]);
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));
        $status = $request->shipment_status;
        $user_type = $request->user_type;
        
        return Excel::download(new ShipmentExport($status,$user_type,$fdate,$tdate), 'shipmentreport.xlsx');
        //return (new BookingExport($fdate,$tdate))->download('report.xlsx');
    }

    public function excelRevenueReport(Request $request){
       // if($request->from_date != null && $request->to_date !=null){
            
            $fdate = date('Y-m-d', strtotime($request->from_date));
            $tdate = date('Y-m-d', strtotime($request->to_date));
            $user_type = $request->user_type;
            
            return Excel::download(new RevenueExport($user_type,$fdate,$tdate), 'revenuereport.xlsx');
        //}
        //return (new BookingExport($fdate,$tdate))->download('report.xlsx');
    }


    public function RevenueReport(){
        $agent=agent::all();
        $language=language::all();
        $user = User::where('status',4)->get();
        return view('admin.revenue_report',compact('agent','language','user'));
    }

    public function AllRevenueReport(){
        $agent=agent::all();
        $language=language::all();
        $user = User::where('status',4)->get();
        return view('admin.all_revenue_report',compact('agent','language','user'));
    }


    public function getRevenueReport($user_type,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $shipment =DB::table('shipments');
        if ( $user_type != 'all_user' )
        {
            if ( $user_type != 'guest' ){
                $shipment->where('shipments.sender_id', $user_type);
                //$shipment->join('users', 'users.id', '=', 'shipments.sender_id');
            }
            else{
                $shipment->where('shipments.sender_id', 0);
            }
        }
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $shipment->whereBetween('shipments.date', [$fdate1, $tdate1]);
        }
        $shipment->where('shipments.status',8);
        $shipment->orderBy('shipments.id','DESC');
        //$shipment = $i->get();

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->first();
                return '<td>#'.$shipment_package->sku_value.'</td>';
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
            
            ->addColumn('total_weight', function ($shipment) {
                return '<td>
                <p>No of Packages : ' .$shipment->no_of_packages . '</p>
                <p>Total Weight ' .$shipment->total_weight . ' Kg</p>
                </td>';
            })
            ->addColumn('shipment_price', function ($shipment) {
                return '<td>
                <p>' .$shipment->shipment_price . ' AED</p>
                </td>';
            })

            ->addColumn('postal_charge', function ($shipment) {
                return '<td>
                <p>' . $shipment->postal_charge_percentage . ' %</p>
                <p>' . $shipment->postal_charge . ' AED</p>
                </td>';
            })
            ->addColumn('vat', function ($shipment) {
                return '<td>
                <p>' . $shipment->vat_percentage . ' %</p>
                <p>' . $shipment->vat_amount . ' AED</p>
                </td>';
            })
            ->addColumn('insurance', function ($shipment) {
                return '<td>
                <p>' . $shipment->insurance_percentage . ' %</p>
                <p>' . $shipment->insurance_amount . ' AED</p>
                </td>';
            })
            ->addColumn('cod_amount', function ($shipment) {
                return '<td>
                <p>' . $shipment->cod_amount . ' AED</p>
                </td>';
            })
            ->addColumn('total', function ($shipment) {
                return '<td>
                <p>' . $shipment->total . ' AED</p>
                </td>';
            })
            
        ->rawColumns(['order_id','postal_charge', 'shipment_price', 'total_weight','total','vat','insurance','cod_amount','account_id'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function getAllRevenueReport($user_type,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('shipments as s');
        if ( $user_type != 'all_user' )
        {
            $i->where('s.sender_id', $user_type);
            //$i->join('users', 'users.id', '=', 's.sender_id');
        }
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('s.date', [$fdate1, $tdate1]);
        }
        $i->where('s.status',8);
        $i->where('s.sender_id','!=',0);
        $i->groupBy('s.sender_id');
        $i->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("SUM(s.special_cod) as special_cod") , DB::raw("SUM(s.total) as total")  , DB::raw("s.sender_id") ]);
        $shipment = $i->get();

        return Datatables::of($shipment)
            ->addColumn('account_id', function ($shipment) {
                $user = User::find($shipment->sender_id);
                return '<td>
                <p>' . $user->customer_id . '</p>
                <p>' . $user->first_name . ' ' . $user->last_name . '</p>
                <p>' . $user->mobile . '</p>
                </td>';
            })
            ->addColumn('no_of_packages', function ($shipment) {
                return '<td>
                <p>No of Packages : ' .$shipment->no_of_packages . '</p>
                </td>';
            })
            ->addColumn('no_of_shipments', function ($shipment) {
                return '<td>
                <p>No of Shipments : ' .$shipment->no_of_shipments . '</p>
                </td>';
            })
            ->addColumn('special_cod', function ($shipment) {
                return '<td>
                <p>' .$shipment->special_cod . ' AED</p>
                </td>';
            })
            ->addColumn('total', function ($shipment) {
                return '<td>
                <p>' . $shipment->total . ' AED</p>
                </td>';
            })
            
        ->rawColumns(['no_of_shipments', 'no_of_packages', 'special_cod','total','account_id'])
        ->addIndexColumn()
        ->make(true);
    }

    public static function printAllRevenueReportUserDetails($id){
        $user = User::find($id);
        return '
        '. $user->customer_id .'
        '. $user->first_name . $user->last_name .'
        '. $user->mobile .'
        ';
    }

    public function printAllRevenueReport(Request $request){
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));
        
        $i =DB::table('shipments as s');
        if ( $request->user_type != 'all_user' )
        {
            $i->where('s.sender_id', $request->user_type);
            $i->join('users', 'users.id', '=', 's.sender_id');
        }
        if ( $fdate != '1970-01-01' && $tdate != '1970-01-01' )
        {
            $i->whereBetween('s.date', [$fdate, $tdate]);
        }
        $i->where('s.status',8);
        $i->where('s.sender_id','!=',0);
        $i->groupBy('s.sender_id');
        $i->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("SUM(s.special_cod) as special_cod") , DB::raw("SUM(s.total) as total")  , DB::raw("s.sender_id") ]);
        $shipment = $i->get();

        $user = User::where('status',4)->get();

        $pdf = PDF::loadView('print.print_all_revenue_report',compact('shipment','fdate','tdate','user'));
        $pdf->setPaper('A4');
        return $pdf->stream('print_all_revenue_report.pdf');

    }



    public function getAgentReport($agent_id,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $shipment =DB::table('shipments');
    
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' && $agent_id != 'agent' )
        {
            $shipment->where([
                ['pickup_agent_id',$agent_id],
                ['status',1],
                ['pickup_assign_date','<=',$tdate1],
                ['pickup_assign_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['package_collect_agent_id',$agent_id],
                ['status',2],
                ['package_collect_date','<=',$tdate1],
                ['package_collect_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['pickup_exception_id',$agent_id],
                ['status',3],
                ['exception_assign_date','<=',$tdate1],
                ['exception_assign_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['transit_in_id',$agent_id],
                ['status',4],
                ['transit_in_date','<=',$tdate1],
                ['transit_in_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['transit_in_id1',$agent_id],
                ['status',11],
                ['transit_in_date','<=',$tdate1],
                ['transit_in_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['transit_out_id',$agent_id],
                ['status',6],
                ['transit_out_date','<=',$tdate1],
                ['transit_out_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['transit_out_id1',$agent_id],
                ['status',12],
                ['transit_out_date','<=',$tdate1],
                ['transit_out_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['package_at_station_id',$agent_id],
                ['status',13],
                ['package_at_station_date','<=',$tdate1],
                ['package_at_station_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['package_at_station_id1',$agent_id],
                ['status',14],
                ['package_at_station_date','<=',$tdate1],
                ['package_at_station_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['van_scan_id',$agent_id],
                ['status',7],
                ['van_scan_date','<=',$tdate1],
                ['van_scan_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['delivery_agent_id',$agent_id],
                ['status',8],
                ['delivery_date','<=',$tdate1],
                ['delivery_date','>=',$fdate1],
            ]);
            $shipment->orWhere([
                ['delivery_exception_id',$agent_id],
                ['status',9],
                ['delivery_exception_assign_date','<=',$tdate1],
                ['delivery_exception_assign_date','>=',$fdate1],
            ]);
        }
        // if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        // {
        //     $shipment->where([
        //         ['status',1],
        //         ['pickup_assign_date','<=',$tdate1],
        //         ['pickup_assign_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',2],
        //         ['package_collect_date','<=',$tdate1],
        //         ['package_collect_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',3],
        //         ['exception_assign_date','<=',$tdate1],
        //         ['exception_assign_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',4],
        //         ['transit_in_date','<=',$tdate1],
        //         ['transit_in_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',11],
        //         ['transit_in_date','<=',$tdate1],
        //         ['transit_in_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',6],
        //         ['transit_out_date','<=',$tdate1],
        //         ['transit_out_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',12],
        //         ['transit_out_date','<=',$tdate1],
        //         ['transit_out_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',13],
        //         ['package_at_station_date','<=',$tdate1],
        //         ['package_at_station_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',14],
        //         ['package_at_station_date','<=',$tdate1],
        //         ['package_at_station_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',7],
        //         ['van_scan_date','<=',$tdate1],
        //         ['van_scan_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',8],
        //         ['delivery_date','<=',$tdate1],
        //         ['delivery_date','>=',$fdate1],
        //     ]);
        //     $shipment->orWhere([
        //         ['status',9],
        //         ['delivery_exception_assign_date','<=',$tdate1],
        //         ['delivery_exception_assign_date','>=',$fdate1],
        //     ]);
        // }
        $shipment->where('status','!=', 0);
        $shipment->where('show_status',0);
        $shipment->orderBy('id','DESC');
        //$shipment->get();

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
            ->addColumn('shipment_mode', function ($shipment) {
                if ($shipment->shipment_mode == 2) {
                    return '<td>Express</td>';
                } else {
                    return '<td>Standard</td>';
                }
            })
            ->addColumn('shipment_date', function ($shipment) {
                if($shipment->status == 0){
                    return '<p>' . date("d-m-Y",strtotime($shipment->date)) . '</p>';
                }
                elseif($shipment->status == 1){
                    return '<p>' . date("d-m-Y",strtotime($shipment->pickup_assign_date)) . '</p>';
                }
                elseif($shipment->status == 2){
                    return '<p>' . date("d-m-Y",strtotime($shipment->package_collect_date)) . '</p>';
                }
                elseif($shipment->status == 3){
                    return '<p>' . date("d-m-Y",strtotime($shipment->exception_assign_date)) . '</p>';
                }
                elseif($shipment->status == 4){
                    return '<p>' . date("d-m-Y",strtotime($shipment->transit_in_date)) . '</p>';
                }
                elseif($shipment->status == 6){
                    return '<p>' . date("d-m-Y",strtotime($shipment->transit_out_date)) . '</p>';
                }
                elseif($shipment->status == 13){
                    return '<p>' . date("d-m-Y",strtotime($shipment->package_at_station_date)) . '</p>';
                }
                elseif($shipment->status == 11){
                    return '<p>' . date("d-m-Y",strtotime($shipment->transit_in_date)) . '</p>';
                }
                elseif($shipment->status == 12){
                    return '<p>' . date("d-m-Y",strtotime($shipment->transit_out_date)) . '</p>';
                }
                elseif($shipment->status == 14){
                    return '<p>' . date("d-m-Y",strtotime($shipment->package_at_station_date)) . '</p>';
                }
                elseif($shipment->status == 7){
                    return '<p>' . date("d-m-Y",strtotime($shipment->van_scan_date)) . '</p>';
                }
                elseif($shipment->status == 8){
                    return '<p>' . date("d-m-Y",strtotime($shipment->delivery_date)) . '</p>';
                }
                elseif($shipment->status == 9){
                    return '<p>' . date("d-m-Y",strtotime($shipment->delivery_exception_assign_date)) . '</p>';
                }
                elseif($shipment->status == 10){
                    return '<p>' . date("d-m-Y",strtotime($shipment->cancel_request_date)) . '</p>';
                }
            })

            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
                $from_station = station::find($shipment->from_station_id);
                $user = User::find($shipment->sender_id);
                if(!empty($from_area)){
                return '<td>
                <p>' . $from_area->city . '</p>
                <p>' . $from_city->city . '</p>
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
            ->addColumn('status', function ($shipment) {
                $to_station = station::find($shipment->to_station_id);
                $from_station = station::find($shipment->from_station_id);
                if($shipment->status == 0){
                    return 'Ready for Pickup';
                }
                elseif($shipment->status == 1){
                    $agent = agent::find($shipment->pickup_agent_id);
                    if(!empty($agent)){
                        return '<td>
                        <p>Schedule for Pickup</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>
                        </td>';
                    }
                    else{
                        return 'Schedule for Pickup';
                    }
                }
                elseif($shipment->status == 2){
                    $agent = agent::find($shipment->package_collect_agent_id);
                    if(!empty($agent)){
                        return '<td>
                        <p>Package Collected</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>
                        </td>';
                    }
                    else{
                        return 'Package Collected';
                    }
                }
                elseif($shipment->status == 3){
                    $agent = agent::find($shipment->pickup_exception_id);
                    if(!empty($agent)){
                        return '<td>
                        <p>Pickup Exception</p>
                        <p>' . $shipment->exception_category . '</p>
                        <p>' . $shipment->exception_remark . '</p>
                        <p>Agent ID :'.$agent->agent_id.'</p>
                        <p>Name :' . $agent->name . '</p>
                        </td>';
                    }
                    else{
                        return '<td>
                        <p>Pickup Exception</p>
                        <p>' . $shipment->exception_category . '</p>
                        <p>' . $shipment->exception_remark . '</p>
                        </td>';
                    }
                }
                elseif($shipment->status == 4){
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
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">AWB Print</a>
                        <a  class="dropdown-item" target="_blank" href="/admin/print-invoice/'.$shipment->id.'" >Print</a>  
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_mode','action','total','status','account_id','special_cod'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function excelAgentReport(Request $request){
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));
        $agent_id = $request->agent_id;
        
        return Excel::download(new AgentExport($agent_id,$fdate,$tdate), 'agentreport.xlsx');
        //return (new BookingExport($fdate,$tdate))->download('report.xlsx');
    }





}
