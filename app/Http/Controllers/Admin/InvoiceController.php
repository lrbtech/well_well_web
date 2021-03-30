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
use App\Models\invoice;
use App\Models\invoice_pay;
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

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function GenerateInvoice(){
        $user = User::where('status',4)->get();
        $language = language::all();
        return view('admin.generate_invoice',compact('user','language'));
    }

    public function GuestGenerateInvoice(){
        $user = User::where('status',4)->get();
        $language = language::all();
        return view('admin.guest_generate_invoice',compact('user','language'));
    }

    public function InvoiceHistory(){
        $user = User::where('status',4)->get();
        $language = language::all();
        return view('admin.invoice_history',compact('user','language'));
    }

    public function getGenerateInvoice($user_type,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('shipments as s');
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('s.delivery_date', [$fdate1, $tdate1]);
        }
        if ( $user_type != 3 )
        {
            $i->join('users', 'users.id', '=', 's.sender_id');
            $i->where('users.user_type', $user_type);
        }
        $i->where('s.sender_id','!=',0);
        $i->where('s.status', 8);
        //$i->orWhere('s.cancel_pay', 1);
        $i->where('s.invoice_status', 0);
        $i->groupBy('s.sender_id');
        $i->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("SUM(s.total) as total") , DB::raw("s.sender_id") ]);
        $shipment = $i->get();

        return Datatables::of($shipment)
            ->addColumn('user_details', function ($shipment) {
                if(!empty($shipment)){
                    if($shipment->sender_id != 0){
                        $user = User::find($shipment->sender_id);
                        return '<td>
                        <p>Customer Id : '.$user->customer_id.'</p>
                        <p>Name : '.$user->first_name.' '.$user->last_name.'</p>
                        </td>';
                    }
                }
            })
            ->addColumn('user_type', function ($shipment) {
                if(!empty($shipment)){
                    if($shipment->sender_id != 0){
                        $user = User::find($shipment->sender_id);
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
                }
            })
            ->addColumn('no_of_shipments', function ($shipment) {
                if(!empty($shipment)){
                return '<td>
                <p>'.$shipment->no_of_shipments.'</p>
                </td>';
                }
            })
            ->addColumn('no_of_packages', function ($shipment) {
                if(!empty($shipment)){
                return '<td>
                <p>'.$shipment->no_of_packages.'</p>
                </td>';
                }
            })

            ->addColumn('total', function ($shipment) {
                if(!empty($shipment)){
                return '<td>
                <p>AED ' . $shipment->total . '</p>
                </td>';
                }
            })
            
            ->addColumn('action', function($shipment) use($fdate,$tdate,$user_type){
                $fdate1 = date('Y-m-d', strtotime($fdate));
                $tdate1 = date('Y-m-d', strtotime($tdate));
                
                $i =DB::table('shipments as s');
                if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
                {
                    $i->whereBetween('s.delivery_date', [$fdate1, $tdate1]);
                }
                if ( $user_type != 3 )
                {
                    $i->join('users', 'users.id', '=', 's.sender_id');
                    $i->where('users.user_type', $user_type);
                }
                $i->where('s.sender_id',$shipment->sender_id);
                $i->where('s.status', 8);
                //$i->orWhere('s.cancel_pay', 1);
                $i->where('s.invoice_status', 0);
                $all_shipment = $i->get();
                
                $order_id = '';
                foreach ($all_shipment as $key => $value) {
                    $datas[] = $value->id;
                } 
                $order_id = collect($datas)->implode(',');

                return '<td>
                    <input type="hidden" name="shipment_id'.$shipment->sender_id.'" id="shipment_id'.$shipment->sender_id.'" value="' . $order_id . '">
                    <p><a onclick="GenerateInvoice('.$shipment->sender_id.')" href="#" >Generate Invoice</a></p>
                </td>';
                
            })
            
        ->rawColumns(['user_details','user_type','no_of_shipments','total','no_of_packages','action'])
        ->addIndexColumn()
        ->make(true);

    }

    public function getGuestGenerateInvoice($fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('shipments as s');
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('s.delivery_date', [$fdate1, $tdate1]);
        }

        $i->where('s.sender_id',0);
        $i->where('s.status', 8);
        $i->where('s.invoice_status', 0);
        $shipment = $i->get();

        return Datatables::of($shipment)
            ->addColumn('user_details', function ($shipment) {
                if($shipment->sender_id == 0){
                    $user = manage_address::find($shipment->from_address);
                    return '<td>
                    <p>Name : '.$user->contact_name.'</p>
                    <p>Mobile : '.$user->contact_mobile.'</p>
                    </td>';
                }
            })
            ->addColumn('no_of_shipments', function ($shipment) {
                return '<td>
                <p>1</p>
                </td>';
            })
            ->addColumn('no_of_packages', function ($shipment) {
                return '<td>
                <p>'.$shipment->no_of_packages.'</p>
                </td>';
            })

            ->addColumn('total', function ($shipment) {
                return '<td>
                <p>AED ' . $shipment->total . '</p>
                </td>';
            })

            ->addColumn('collect_amount', function ($shipment) {
                return '<td>
                <p>AED ' . $shipment->collect_cod_amount . '</p>
                </td>';
            })
            
            ->addColumn('action', function ($shipment) {
                return '<td>
                    <p><a onclick="GenerateInvoice('.$shipment->id.')" href="#" >Generate Invoice</a></p>
                </td>';
            })
            
        ->rawColumns(['user_details','no_of_shipments','total','no_of_packages','action','collect_amount'])
        ->addIndexColumn()
        ->make(true);
        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function createGenerateInvoice(Request $request)
    {
        $arraydata=array();
        //foreach($request->shipment_id as $row){
            foreach(explode(',',$request->shipment_id) as $shipment_id1){
            $arraydata[]=$shipment_id1;
            }
        //}
       
        $data = shipment::whereIn('id', $arraydata)->get();
        $total=0;
        $no_of_shipments=0;
        $no_of_packages=0;
        foreach ($data as $row) {
            $shipment = shipment::find($row->id);
            $no_of_shipments++;
            $no_of_packages=$no_of_packages + $shipment->no_of_packages;
            $total=$total+$shipment->total;

            $shipment->invoice_status = 1;
            $shipment->save();
        }

        $config = [
            'table' => 'invoices',
            'field' => 'invoice_id',
            'length' => 10,
            'prefix' => 'INV-'
        ];

        $order_id = IdGenerator::generate($config);
        $user = User::find($request->id);

        $address = manage_address::find($user->address_id);
        $city = city::find($address->city_id);
        $area = city::find($address->area_id);

        $invoice = new invoice;
        $invoice->invoice_id = $order_id;
        $invoice->date = date('Y-m-d');
        $invoice->sender_id = $user->id;
        $invoice->account_id = $user->customer_id;
        $invoice->name = $user->first_name .' '.$user->last_name;
        $invoice->mobile = $user->mobile;
        $invoice->email = $user->email;
        $invoice->city = $city->city;
        $invoice->area = $area->city;
        $invoice->address1 = $address->address1;
        $invoice->address2 = $address->address2;
        $invoice->address3 = $address->address3;
        $invoice->no_of_shipments = $no_of_shipments;
        $invoice->no_of_packages = $no_of_packages;
        $invoice->shipment_ids = $request->shipment_id;
        $invoice->total = $total;
        $invoice->save();

        return response()->json(["Successfully Update"], 200);
    }


    public function createGuestGenerateInvoice(Request $request)
    {
        $shipment = shipment::find($request->id);
        $shipment->invoice_status = 1;
        $shipment->save();

        $config = [
            'table' => 'invoices',
            'field' => 'invoice_id',
            'length' => 10,
            'prefix' => 'INV-'
        ];

        $order_id = IdGenerator::generate($config);

        $address = manage_address::find($shipment->from_address);
        $city = city::find($address->city_id);
        $area = city::find($address->area_id);

        $invoice = new invoice;
        $invoice->invoice_id = $order_id;
        $invoice->date = date('Y-m-d');
        $invoice->sender_id = 0;
        $invoice->account_id = 0;
        $invoice->name = $address->contact_name;
        $invoice->mobile = $address->contact_mobile;
        //$invoice->email = $address->email;
        $invoice->city = $city->city;
        $invoice->area = $area->city;
        $invoice->address1 = $address->address1;
        $invoice->address2 = $address->address2;
        $invoice->address3 = $address->address3;
        $invoice->no_of_shipments = 1;
        $invoice->no_of_packages = $shipment->no_of_packages;
        $invoice->shipment_ids = $shipment->id;
        $invoice->total = $shipment->total;
        if($shipment->collect_cod_amount != ''){
            $invoice->paid = $shipment->total;
        }
        $invoice->save();

        return response()->json(["Successfully Update"], 200);
    }


    public function getInvoiceHistory($user_type,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        
        $i =DB::table('invoices as i');
        if ( $fdate1 && $fdate != '1' && $tdate1 && $tdate != '1' )
        {
            $i->whereBetween('i.date', [$fdate1, $tdate1]);
        }
        if ( $user_type != 3 )
        {
            $i->join('users', 'users.id', '=', 'i.sender_id');
            $i->where('users.user_type', $user_type);
        }
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
                        <a class="dropdown-item" href="#" onclick="newPayment('.$invoice->id.')">Add Payment</a> 
                        <a class="dropdown-item" href="#" onclick="viewPayment('.$invoice->id.')">View Payment</a>    
                        <a onclick="PrintInvoice('.$invoice->id.')" class="dropdown-item" href="#" >Print</a>
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

        //return view('print.invoiceprint',compact('invoice','invoice_item'));
        //return response()->json(count($invoice_item));
        // $pdf = PDF::loadView('print.invoiceprint',compact('invoice','invoice_item'));
        // $pdf->setPaper('A4');
        // return $pdf->stream('invoice.pdf');

        $view = view('print.invoiceprint',compact('invoice','invoice_item'))->render();
        return response()->json(['html'=>$view]);
    }


    public function newInvoicePayment($id){
        $invoice = invoice::find($id);
        $invoice_pay = invoice_pay::where('invoice_id',$id)->get();
        
        $paid = 0;
        $balance =0;
        foreach ($invoice_pay as $key => $value) {
            $paid = $paid + $value->amount;
        }
        $balance = $invoice->total - $paid;
        $data = array(
            'id' => $invoice->id,
            'sender_id' => $invoice->sender_id,
            'total' => $invoice->total,
            'paid' => $paid,
            'balance' => $balance,
        );
        return response()->json($data); 
    }

    public function saveInvoicePayment(Request $request){
        $request->validate([
           'payment_type'=>'required',
           'new_payment'=>'required',
        ]);

        $invoice_pay = new invoice_pay;
        $invoice_pay->invoice_id = $request->id;
        $invoice_pay->date = date('Y-m-d', strtotime($request->date));
        $invoice_pay->sender_id = $request->sender_id;
        $invoice_pay->admin_id = Auth::guard('admin')->user()->id;
        $invoice_pay->payment_type = $request->payment_type;
        $invoice_pay->payment_description = $request->payment_description;
        $invoice_pay->amount = $request->new_payment;

        if($request->new_payment > 0){
        $invoice_pay->save();
            $invoice = invoice::find($request->id);
            $invoice->paid = $invoice->paid + $request->new_payment;
            $invoice->save();
        }

        return response()->json('Successfully Save'); 
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
