<?php

namespace App\Http\Controllers\User;

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
use App\Models\language;
use App\Models\user_settlement;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Mail;
use PDF;
use App\Exports\UserShipmentExport;
use App\Exports\UserRevenueExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function ShipmentReport(){
        $agent=agent::all();
        $language = language::all();
        return view('user.shipment_report',compact('agent','language'));
    }


    public function getShipmentReport($status,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('shipments');

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
        $i->where('shipments.sender_id',Auth::user()->id);
        $i->orderBy('shipments.id','DESC');
        $shipment = $i->get();

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
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
            ->addColumn('status', function ($shipment) {
                if($shipment->status == 0){
                    return 'Ready for Pickup';
                }
                elseif($shipment->status == 1){
                    return 'Schedule for Pickup';
                }
                elseif($shipment->status == 2){
                    return 'Package Collected';
                }
                elseif($shipment->status == 3){
                    return '<td>
                    <p>Pickup Exception</p>
                    <p>' . $shipment->exception_category . '</p>
                    <p>' . $shipment->exception_remark . '</p>
                    </td>';
                }
                elseif($shipment->status == 4){
                    $from_station = station::find($shipment->from_station_id);
                        return '
                        <p>Transit In '.$from_station->station.'</p>'
                       ;
                }
                elseif($shipment->status == 5){
                    return 'Assign Agent to Transit Out (Hub)';
                }
                elseif($shipment->status == 6){
                    $to_station = station::find($shipment->to_station_id);
                    return '
                    <p>Transit Out '.$to_station->station.'</p>'
                    ;
                }
                elseif($shipment->status == 7){
                    return '
                    <p>In the Van for Delivery</p>'
                    ;
                }
                elseif($shipment->status == 8){
                    return '
                    <p>Shipment delivered</p>'
                    ;
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
            })
            ->addColumn('action', function ($shipment) {
                if($shipment->status == 8){
                    return '<td>
                    <p><a target="_blank" href="/user/print-invoice/'.$shipment->id.'" >Print</a></p>
                    </td>';
                }
                else{
                    return '<td>
                    <p><a onclick="PrintLabel('.$shipment->id.')" href="#">Print</a></p>
                    </td>';
                }
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_mode','action','total','status'])
        ->addIndexColumn()
        ->make(true);
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
        $user_id = Auth::user()->id;
        
        return Excel::download(new UserShipmentExport($status,$fdate,$tdate,$user_id), 'shipmentreport.xlsx');
        //return (new BookingExport($fdate,$tdate))->download('report.xlsx');
    }

    public function excelRevenueReport(Request $request){
       // if($request->from_date != null && $request->to_date !=null){
            
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));
        $user_id = Auth::user()->id;
        
        return Excel::download(new UserRevenueExport($fdate,$tdate,$user_id), 'revenuereport.xlsx');
        //}
        //return (new BookingExport($fdate,$tdate))->download('report.xlsx');
    }


    public function RevenueReport(){
        $agent=agent::all();
        $language=language::all();
        return view('user.revenue_report',compact('agent','language'));
    }


    public function getRevenueReport($fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('shipments');
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('shipments.date', [$fdate1, $tdate1]);
        }
        $i->where('shipments.sender_id',Auth::user()->id);
        $i->where('shipments.status',8);
        $i->orderBy('shipments.id','DESC');
        $shipment = $i->get();

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
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
            
        ->rawColumns(['order_id','postal_charge', 'shipment_price', 'total_weight','total','vat','insurance','cod_amount'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function PaymentsInReport(){
        $language = language::all();
        return view('user.payments_in',compact('language'));
    }

    public function settlementDetails(){
        $language = language::all();
        $user_settlement = user_settlement::where('user_id',Auth::user()->id)->get();
        return view('user.settlement_details',compact('language','user_settlement'));
    }

    public function getPaymentsInReport($fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('shipments as s');
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('s.delivery_date', [$fdate1, $tdate1]);
        }
        $i->where('s.sender_id', Auth::user()->id);
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

            ->addColumn('settlement_value', function ($shipment) {
                $user = User::find($shipment->sender_id);
                return '<td>
                <p>AED ' . $user->paid . '</p>
                </td>';
            })
            
            
        ->rawColumns(['user_details','no_of_shipments', 'total_value','settlement_value'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }



}
