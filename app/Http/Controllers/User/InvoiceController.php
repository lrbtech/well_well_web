<?php

namespace App\Http\Controllers\User;

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
use App\Models\invoice;
use App\Models\invoice_pay;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Mail;
use PDF;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }
    public function InvoiceHistory(){
        $user = User::where('status',4)->get();
        $language = language::all();
        return view('user.invoice_history',compact('user','language'));
    }


    public function getInvoiceHistory($fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('invoices as i');
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('i.date', [$fdate1, $tdate1]);
        }
        $i->where('i.sender_id', Auth::user()->id);
        $invoice = $i->get();

        return Datatables::of($invoice)
            ->addColumn('invoice_date', function ($invoice) {
                return '<td>
                <p>'.date('d-m-Y',strtotime($invoice->date)).'</p>
                </td>';
            })
            ->addColumn('user_details', function ($invoice) {
                return '<td>
                <p>Customer Id : '.$invoice->account_id.'</p>
                <p>Name : '.$invoice->name.'</p>
                </td>';
            })
            ->addColumn('user_type', function ($invoice) {
                if($invoice->sender_id != 0){
                    $user = User::find($invoice->sender_id);
                    if($user->user_type == 0){
                        return '<p>Individual</p>';
                    }
                    else{
                        return '<p>Commercial</p>';
                    }
                }
                else{
                    return '<td>
                    <p>Guest</p>
                    </td>';
                }
            })
            ->addColumn('no_of_shipments', function ($invoice) {
                return '<td>
                <p>'.$invoice->no_of_shipments.'</p>
                </td>';
            })
            
            ->addColumn('no_of_packages', function ($invoice) {
                return '<td>
                <p>'.$invoice->no_of_packages.'</p>
                </td>';
            })

            ->addColumn('total', function ($invoice) {
                return '<td>
                <p>AED ' . $invoice->total . '</p>
                </td>';
            })
            
            ->addColumn('action', function($invoice){
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="#" onclick="viewPayment('.$invoice->id.')">View Payment</a>    
                        <a target="_blank" class="dropdown-item" href="/user/invoice-print/'.$invoice->id.'" >Print</a>
                    </div>
                </td>';
            })
            
        ->rawColumns(['user_details','invoice_date','user_type','no_of_shipments','total','no_of_packages','action'])
        ->addIndexColumn()
        ->make(true);
    }


    public function InvoicePrint($id){
        $invoice = invoice::find($id);

        $arraydata=array();
        foreach(explode(',',$invoice->shipment_ids) as $shipment_id1){
        $arraydata[]=$shipment_id1;
        }
       
        $data = shipment::whereIn('id', $arraydata)->get();
        $data1=array();
        //$invoice_item=array();
        foreach ($data as $row) {
            $shipment = shipment::find($row->id);
            $shipment_package = shipment_package::where('shipment_id',$row->id)->first();
            $data1 = array(
                'delivery_date'=>$shipment->delivery_date,
                'tracking_id'=>$shipment_package->sku_value,
                'no_of_packages'=>$shipment->no_of_packages,
                'total'=>$shipment->total,
                'cancel_pay'=>$shipment->cancel_pay,
            );
            $invoice_item[]=$data1;
        }

       // return response()->json($invoice_item);
        $pdf = PDF::loadView('print.invoiceprint',compact('invoice','invoice_item'));
        $pdf->setPaper('A4');
        return $pdf->stream('invoice.pdf');
    }


    public function viewInvoicePayment($id)
    {
        $invoice_pay = invoice_pay::where('invoice_id',$id)->get();
        $output = '<table id="sales_payment_table" class="table table-primary table-bordered mb-0">
        <thead class="thead-primary">
          <tr>
            <th style="width:20%;">Date</th>
            <th style="width:20%;">Payment type</th>
            <th style="width:30%;">Description</th>
            <th style="width:20%;">Amount</th>
          </tr>
        </thead>
        <tbody>';
           foreach ($invoice_pay as $value) {
           
            $output .='<tr>
                <td>'.date('d-m-Y', strtotime($value->date)).'</td>
                <td>'.$value->payment_type.'</td>
                <td>'.$value->payment_description.'</td>
                <td>'.$value->amount.'</td>
            </tr>';
           }
           $output .='</tbody>
        </table>';

        echo $output;
    }


}
