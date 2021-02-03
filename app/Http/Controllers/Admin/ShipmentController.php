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
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Mail;
use PDF;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function newShipment(){
        $drop_point = drop_point::all();
        $country = country::all();
        $agent = agent::all();
        $package_category = package_category::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();

        return view('admin.new_shipment',compact('drop_point','country','city','area','package_category','agent'));
    }

    public function viewShipment($id){
        $country = country::all();
        $agent = agent::all();
        $package_category = package_category::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();

        $shipment =shipment::find($id);
        $user =User::find($shipment->sender_id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();
        $shipment_notes = shipment_notes::where('shipment_id',$id)->get();

        $from_address =manage_address::find($shipment->from_address);
        $to_address =manage_address::find($shipment->to_address);

        return view('admin.view_shipment',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user'));
    }

    public function saveShipmentNotes(Request $request){
        $shipment_notes = new shipment_notes;
        $shipment_notes->shipment_id = $request->shipment_id;
        $shipment_notes->admin_id = Auth::guard('admin')->user()->id;
        $shipment_notes->notes = $request->notes;
        $shipment_notes->save();

        return response()->json('successfully save'); 
    }

    public function saveNewAddress(Request $request){
        $this->validate($request, [
            'city_id'=>'required',
            'country_id'=>'required',
            'area_id'=>'required',
            'address_type'=>'required',
            'address1'=> 'required',
          ],[
            'city_id.required' => 'City Field is Required',
            'country_id.required' => 'Country Field is Required',
            'area_id.required' => 'Area Field is Required',
            'address1.required' => 'Atlease Address One Field is Required',
        ]);

        $manage_address = new manage_address;
        $manage_address->user_id = $request->customer_id;
        $manage_address->from_to = $request->from_to;
        $manage_address->city_id = $request->city_id;
        $manage_address->area_id = $request->area_id;
        $manage_address->country_id = $request->country_id;
        $manage_address->contact_name = $request->contact_name;
        $manage_address->contact_mobile = $request->contact_mobile;
        $manage_address->contact_landline = $request->contact_landline;
        $manage_address->address_type = $request->address_type;
        $manage_address->latitude = $request->latitude;
        $manage_address->longitude = $request->longitude;
        $manage_address->address1 = $request->address1;
        $manage_address->address2 = $request->address2;
        $manage_address->address3 = $request->address3;
        $manage_address->save();

        return response()->json('successfully save'); 
    }

    public function saveNewShipment(Request $request){
        $this->validate($request, [
            'from_address'=>'required',
            'to_address'=>'required',
            'shipment_date'=>'required',
            'shipment_from_time'=>'required',
            'shipment_type'=>'required',
            'shipment_mode'=> 'required',
            //'price.*'=> 'required',
          ],[
            'from_address.required' => 'Choose From Address Field is Required',
            'to_address.required' => 'Choose To Address Field is Required',
            'shipment_type.required' => 'Pickup/Drop-Off Field is Required',
            //'price.*.required' => 'Price Field is Required',
        ]);

        $config = [
            'table' => 'shipments',
            'field' => 'order_id',
            'length' => 6,
            'prefix' => '0'
        ];

        $order_id = IdGenerator::generate($config);

        do {
            $barcode_shipment = mt_rand( 1000000000, 9999999999 );
        } 
        while ( DB::table( 'shipments' )->where( 'barcode_shipment', $barcode_shipment )->exists() );

        $from_address = manage_address::find($request->from_address);
        $from_station = city::find($from_address->city_id);

        $to_address = manage_address::find($request->to_address);
        $to_station = city::find($to_address->city_id);

        $shipment = new shipment;
        $shipment->order_id = $order_id;
        $shipment->barcode_shipment = $barcode_shipment;
        $shipment->date = date('Y-m-d');
        $shipment->sender_id = $request->user_id;
        $shipment->shipment_type = $request->shipment_type;
        $shipment->shipment_date = date('Y-m-d',strtotime($request->shipment_date));
        $shipment->shipment_from_time = $request->shipment_from_time;
        $shipment->shipment_to_time = $request->shipment_to_time;
        $shipment->from_address = $request->from_address;
        $shipment->to_address = $request->to_address;
        $shipment->from_station_id = $from_station->station_id;
        $shipment->to_station_id = $to_station->station_id;
        $shipment->shipment_mode = $request->shipment_mode;
        $shipment->return_package_cost_enable = $request->return_package_cost_enable;
        $shipment->special_cod_enable = $request->special_cod_enable;
        $shipment->special_cod = $request->special_cod;
        $shipment->no_of_packages = $request->no_of_packages;
        $shipment->declared_value = $request->declared_value;
        $shipment->total_weight = $request->total_weight;
        $shipment->shipment_price = $request->shipment_price;
        $shipment->postal_charge_percentage = $request->postal_charge_percentage;
        $shipment->postal_charge = $request->postal_charge;
        $shipment->sub_total = $request->sub_total;
        $shipment->vat_percentage = $request->vat_percentage;
        $shipment->vat_amount = $request->vat_amount;
        $shipment->insurance_percentage = $request->insurance_percentage;
        $shipment->insurance_amount = $request->insurance_amount;
        $shipment->before_total = $request->before_total;
        $shipment->cod_amount = $request->cod_amount;
        $shipment->total = $request->total;
        $shipment->save();

        if($request->same_data == '0'){
            for ($x=0; $x<count($_POST['weight']); $x++) 
            {
                do {
                    $barcode_package = mt_rand( 1000000000, 9999999999 );
                } 
                while ( DB::table( 'shipment_packages' )->where( 'barcode_package', $barcode_package )->exists() );

                $shipment_package = new shipment_package;
                $shipment_package->barcode_package = $barcode_package;
                $shipment_package->shipment_id = $shipment->id;
                $shipment_package->category = $_POST['category'][$x];
                $shipment_package->description = $_POST['description'][$x];
                $shipment_package->weight = $_POST['weight'][$x];
                $shipment_package->length = $_POST['length'][$x];
                $shipment_package->width = $_POST['width'][$x];
                $shipment_package->height = $_POST['height'][$x];
                $shipment_package->chargeable_weight = $_POST['chargeable_weight'][$x];

                if($_POST['weight'][$x]!=""){
                    $shipment_package->save();
                }
            }
        }
        else{
            for ($y=1; $y<=$request->no_of_packages; $y++){
                for ($x=0; $x<count($_POST['weight']); $x++) 
                {
                    do {
                        $barcode_package = mt_rand( 1000000000, 9999999999 );
                    } 
                    while ( DB::table( 'shipment_packages' )->where( 'barcode_package', $barcode_package )->exists() );
                    $shipment_package = new shipment_package;
                    $shipment_package->barcode_package = $barcode_package;
                    $shipment_package->shipment_id = $shipment->id;
                    $shipment_package->category = $_POST['category'][$x];
                    $shipment_package->description = $_POST['description'][$x];
                    $shipment_package->weight = $_POST['weight'][$x];
                    $shipment_package->length = $_POST['length'][$x];
                    $shipment_package->width = $_POST['width'][$x];
                    $shipment_package->height = $_POST['height'][$x];
                    $shipment_package->chargeable_weight = $_POST['chargeable_weight'][$x];

                    if($_POST['weight'][$x]!=""){
                        $shipment_package->save();
                    }
                }
            }
        }
        //return response()->json('successfully save'); 
        return $this->printLabel($shipment->id);
    }


    public function Shipment(){
        $agent=agent::all();
        return view('admin.shipment',compact('agent'));
    }

    public function assignAgent(Request $request){
        $shipment = shipment::find($request->shipment_id);
        $shipment->pickup_agent_id = $request->pickup_agent_id;
        $shipment->pickup_assign_date_time = date('Y-m-d H:i:s');
        $shipment->status = 1;
        $shipment->save();
        return response()->json('successfully update'); 
    }

    public function pickupStation($id){
        $country = country::all();
        $agent = agent::all();
        $package_category = package_category::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();

        $shipment =shipment::find($id);
        $user =User::find($shipment->sender_id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();
        $shipment_notes = shipment_notes::where('shipment_id',$id)->get();

        $from_address =manage_address::find($shipment->from_address);
        $to_address =manage_address::find($shipment->to_address);

        return view('admin.pickup_station',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user'));
    }

    public function updatePickupStation(Request $request){
        $shipment = shipment::find($request->shipment_id);
        $shipment->pickup_received_date_time = date('Y-m-d H:i:s');
        $shipment->status = 4;
        $shipment->save();
        return response()->json('successfully update'); 
    }

    public function AssignAgentStation(Request $request){
        $shipment = shipment::find($request->shipment_id1);
        $shipment->station_agent_id = $request->station_agent_id;
        $shipment->station_assign_date_time = date('Y-m-d H:i:s');
        $shipment->status = 5;
        $shipment->save();
        return response()->json('successfully update'); 
    }

    public function receivedStation($id){
        $country = country::all();
        $agent = agent::all();
        $package_category = package_category::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();

        $shipment =shipment::find($id);
        $user =User::find($shipment->sender_id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();
        $shipment_notes = shipment_notes::where('shipment_id',$id)->get();

        $from_address =manage_address::find($shipment->from_address);
        $to_address =manage_address::find($shipment->to_address);

        return view('admin.received_station',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user'));
    }

    public function updateReceivedStation(Request $request){
        $shipment = shipment::find($request->shipment_id);
        $shipment->station_received_date_time = date('Y-m-d H:i:s');
        $shipment->status = 6;
        $shipment->save();
        return response()->json('successfully update'); 
    }

    public function AssignAgentDelivery(Request $request){
        $shipment = shipment::find($request->shipment_id2);
        $shipment->delivery_agent_id = $request->delivery_agent_id;
        $shipment->delivery_assign_date_time = date('Y-m-d H:i:s');
        $shipment->status = 7;
        $shipment->save();
        return response()->json('successfully update'); 
    }

    public function ShipmentDelivery($id){
        $country = country::all();
        $agent = agent::all();
        $package_category = package_category::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();

        $shipment =shipment::find($id);
        $user =User::find($shipment->sender_id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();
        $shipment_notes = shipment_notes::where('shipment_id',$id)->get();

        $from_address =manage_address::find($shipment->from_address);
        $to_address =manage_address::find($shipment->to_address);

        return view('admin.shipment_delivery',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user'));
    }

    public function updateShipmentDelivery(Request $request){
        $this->validate($request, [
            'receiver_id_copy' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'receiver_id_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
            'receiver_id_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
        ]);

        $shipment = shipment::find($request->shipment_id);
        $shipment->delivery_date_time = date('Y-m-d H:i:s');
        $shipment->status = 8;

        if($request->file('receiver_id_copy')!=""){
            $fileName = null;
            $image = $request->file('receiver_id_copy');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $shipment->receiver_id_copy = $fileName;
        }
        
        $shipment->receiver_signature = $request->signature_data;

        $shipment->save();

        $all = shipment::find($request->shipment_id);
        $user = User::find($all->sender_id);
        $package_category = package_category::all();
        $shipment_package = shipment_package::where('shipment_id',$request->shipment_id)->get();

        Mail::send('mail.delivery_complete',compact('all','shipment_package','package_category'),function($message) use($user){
            $message->to($user->email)->subject('Well Well Express - Delivery Completed');
            $message->from('info@lrbinfotech.com','Well Well Express');
        });

        return response()->json('successfully update'); 
    }

    public function getShipment(){
        if(Auth::guard('admin')->user()->station_id == '0'){
            $shipment = shipment::all();
        }
        else{
            $shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->get();
        }
        

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                return '<td>#'.$shipment->order_id.'</td>';
            })
            ->addColumn('shipment_time', function ($shipment) {
                return '<td>'.$shipment->shipment_from_time.' to '.$shipment->shipment_to_time.'</td>';
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
                if($shipment->status == 0){
                    return 'New Request';
                }
                elseif($shipment->status == 1){
                    return 'Approved';
                }
                elseif($shipment->status == 2){
                    return 'Package Collected';
                }
                elseif($shipment->status == 3){
                    return 'Exception';
                    return '<td>
                    <p>Exception</p>
                    <p>' . $shipment->exception_remark . '</p>
                    </td>';
                }
                elseif($shipment->status == 4){
                    return 'Received Station Hub';
                }
                elseif($shipment->status == 5){
                    return 'Assign Agent to Transit Out (Hub)';
                }
                elseif($shipment->status == 6){
                    return 'Other Transit in Received (Hub)';
                }
                elseif($shipment->status == 7){
                    return 'Assign Agent to Delivery';
                }
                elseif($shipment->status == 8){
                    return 'Shipment delivered';
                }
            })
            ->addColumn('action', function ($shipment) {
                $output='';
                $output1='';
                if($shipment->status == 0){
                    $output.='<a onclick="AssignAgent('.$shipment->id.')" class="dropdown-item" href="#">Assign Agent</a>';
                }
                elseif($shipment->status == 2){
                    $output.='<a class="dropdown-item" href="/admin/pickup-station/'.$shipment->id.'">Received Station Hub</a>';
                }
                elseif($shipment->status == 4){
                    if($shipment->from_station_id == $shipment->to_station_id){
                        $output.='<a onclick="AssignAgentDelivery('.$shipment->id.')" class="dropdown-item">Agent Assign to Delivery</a>';
                    }
                    else{
                        $output.='<a onclick="AssignAgentStation('.$shipment->id.')" class="dropdown-item">Assign Agent to Transit out (Hub)</a>';
                    }
                }
                elseif($shipment->status == 5){
                    $output.='<a href="/admin/received-station/'.$shipment->id.'" class="dropdown-item">Other Transit in Received (Hub)</a>';
                }
                elseif($shipment->status == 6){
                    $output.='<a onclick="AssignAgentDelivery('.$shipment->id.')" class="dropdown-item">Agent Assign to Delivery</a>';
                }
                elseif($shipment->status == 7){
                    $output.='<a href="/admin/shipment-delivery/'.$shipment->id.'" class="dropdown-item">Shipment Delivery</a>';
                }

                if($shipment->status == 8){
                    $output1.='<a target="_blank" href="/admin/print-invoice/'.$shipment->id.'" class="dropdown-item">Print</a>';
                }
                else{
                    $output1.='<a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>';
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="/admin/view-shipment/'.$shipment->id.'">View Shipment</a>    
                        '.$output1.'
                        '.$output.'
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','agent'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getAreaPrice($weight,$to_address,$shipment_mode,$user_id){
        $rate = add_rate::where('user_id',$user_id)->first();
        $address = manage_address::find($to_address);
        $area = city::find($address->area_id);
        $data =array();

        $rate_item = add_rate_item::where('user_id',$user_id)->where('status',$shipment_mode)->get();
        $price=0;
        
        if($area->remote_area == '0'){
            if(!empty($rate_item)){
                foreach($rate_item as $row){
                    if($row->weight_from <= $weight && $row->weight_to >= $weight ){
                        $price = $row->price;
                    }
                    elseif('20.1' <= $weight && '1000' >= $weight && $shipment_mode == '1'){
                        $price = $weight * $rate->service_area_20_to_1000_kg_price;
                    }
                    elseif('20.1' <= $weight && '1000' >= $weight && $shipment_mode == '2'){
                        $price = $weight * $rate->same_day_delivery_20_to_1000_kg_price;
                    }
                }
            }
        }
        else{
            if(!empty($rate_item)){
                foreach($rate_item as $row){
                    if($row->weight_from <= $weight && $row->weight_to >= $weight ){
                        $price = $row->price;
                    }
                    elseif('20.1' <= $weight && '1000' >= $weight && $shipment_mode == '1'){
                        $price = $weight * $rate->service_area_20_to_1000_kg_price;
                    }
                    elseif('20.1' <= $weight && '1000' >= $weight && $shipment_mode == '2'){
                        $price = $weight * $rate->same_day_delivery_20_to_1000_kg_price;
                    }
                }
            }
            else{
                if('0' <= $weight && '5' >= $weight){
                    $price = $rate->before_5_kg_price;
                }
                else{
                    $price = $weight * $rate->above_5_kg_price;
                }
            }
        }
        
      
        $data['price'] = $price;
              

        return response()->json($data); 
    }

    // public function getAreaPrice($weight,$to_address,$shipment_mode,$user_id){
        
    //     $rate = add_rate::where('user_id',$user_id)->first();
    //     $address = manage_address::find($to_address);
    //     $area = city::find($address->area_id);
    //     $data =array();

    //     $rate_item = add_rate_item::where('user_id',$user_id)->where('status',$shipment_mode)->where('weight_from','<=',$weight)->where('weight_to','>=',$weight)->first();

    //     if(!empty($rate_item)){
    //         if($area->remote_area == 0){
    //             $data['price'] = $rate_item->price;
    //         }
    //         else{
    //             if('0' <= $weight && '5' >= $weight){
    //                 $data['price'] = $rate->before_5_kg_price;
    //             }
    //             else{
    //                 $data['price'] = $weight * $rate->above_5_kg_price;
    //             }
    //         }
    //     }else{
    //         $data['price'] = 0;
    //     }

    //     return response()->json($data); 
    // }

    public function printLabel($id){
        $shipment = shipment::find($id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();

        $shipment_count = shipment_package::where('shipment_id',$id)->count();

        $all_shipments = DB::table("shipment_packages as sp")
        ->where("sp.shipment_id",$id)
        ->join('shipments as s', 's.id', '=', 'sp.shipment_id')
        ->join('stations as st', 'st.id', '=', 's.to_station_id')
        ->select('s.*','sp.*','st.*')
        //->groupBy("users.id")
        ->get();

        $country = country::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $from_address = manage_address::find($shipment->from_address);
        $to_address = manage_address::find($shipment->to_address);
        $view = view('print.printlabel',compact('shipment','shipment_package','country','city','area','from_address','to_address','shipment_count','all_shipments'))->render();

        return response()->json(['html'=>$view]);
    }

    public function printInvoice($id){
        $shipment = shipment::find($id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();

        $shipment_count = shipment_package::where('shipment_id',$id)->count();
        $customer = User::find($shipment->sender_id);

        $all_shipments = DB::table("shipment_packages as sp")
        ->where("sp.shipment_id",$id)
        ->join('shipments as s', 's.id', '=', 'sp.shipment_id')
        ->join('stations as st', 'st.id', '=', 's.to_station_id')
        ->select('s.*','sp.*','st.*')
        //->groupBy("users.id")
        ->get();

        $country = country::all();
        $package_category = package_category::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $from_address = manage_address::find($shipment->from_address);
        $to_address = manage_address::find($shipment->to_address);

        $pdf = PDF::loadView('print.printinvoice',compact('shipment','shipment_package','country','city','area','from_address','to_address','shipment_count','all_shipments','customer','package_category'));
        $pdf->setPaper('A4');
        return $pdf->stream('report.pdf');
    }

}
