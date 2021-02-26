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
use App\Models\shipment_notification;
use App\Models\User;
use App\Models\add_rate;
use App\Models\add_rate_item;
use App\Models\station;
use App\Models\agent;
use App\Models\settings;
use App\Models\language;
use App\Models\temp_shipment;
use App\Models\temp_shipment_package;
use App\Models\system_logs;
use App\Models\weeks;
use App\Models\shipment_notes;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use PDF;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function newShipment(){
        $settings = settings::find(1);
        $drop_point = drop_point::all();
        $country = country::where('status',0)->get();
        $package_category = package_category::where('status',0)->get();
        $city = city::where('parent_id',0)->where('status',0)->get();
        $area = city::where('parent_id','!=',0)->where('status',0)->get();
        $address = manage_address::where('user_id',Auth::user()->id)->get();
        $user = User::find(Auth::user()->id);
        $add_rate = add_rate::where('user_id',Auth::user()->id)->first();
        $language = language::all();

        return view('user.new_shipment',compact('drop_point','country','city','area','address','user','package_category','add_rate','settings','language'));
    }

    public function saveNewAddress(Request $request){
        $this->validate($request, [
            'city_id'=>'required',
            'country_id'=>'required',
            'area_id'=>'required',
            'address_type'=>'required',
            'address1'=> 'required',
            'contact_name'=> 'required',
            'contact_mobile'=> 'required|digits:9',
          ],[
            'city_id.required' => 'City Field is Required',
            'country_id.required' => 'Country Field is Required',
            'area_id.required' => 'Area Field is Required',
            'address1.required' => 'Atlease Address One Field is Required',
        ]);

        $manage_address = new manage_address;
        $manage_address->user_id = Auth::user()->id;
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
        
        $system_logs = new system_logs;
        $system_logs->_id = $manage_address->id;
        $system_logs->category = 'address';
        $system_logs->to_id = Auth::user()->email;
        $system_logs->remark = $manage_address->from_to == 1 ?'From Address':'To Address'.'Created By Customer';
        $system_logs->save();


        return response()->json($manage_address); 
    }

    public function saveNewShipment(Request $request){
        $this->validate($request, [
            //'from_address'=>'required',
            //'to_address'=>'required',
            //'shipment_date'=>'required',
            //'shipment_from_time'=>'required',
            //'shipment_type'=>'required',
            'shipment_mode'=> 'required',
            'no_of_packages'=> 'required',
            'declared_value'=> 'required',
            'category.*'=> 'required',
            'description.*'=> 'required',
            'reference_no.*'=> 'required',
            'weight.*'=> 'required',
            'length.*'=> 'required',
            'width.*'=> 'required',
            'height.*'=> 'required',
            'chargeable_weight.*'=> 'required',
          ],[
            //'from_address.required' => 'Choose From Address Field is Required',
            //'to_address.required' => 'Choose To Address Field is Required',
            //'shipment_type.required' => 'Pickup/Drop-Off Field is Required',
            //'price.*.required' => 'Price Field is Required',
        ]);

        $from_address = manage_address::find($request->from_address);
        $from_station = city::find($from_address->city_id);

        $to_address = manage_address::find($request->to_address);
        $to_station = city::find($to_address->city_id);

        $shipment = new temp_shipment;
        $shipment->date = date('Y-m-d');
        $shipment->sender_id = Auth::user()->id;
        $shipment->shipment_type = $request->shipment_type;
        $shipment->from_address = $request->from_address;
        $shipment->to_address = $request->to_address;
        $shipment->from_station_id = $from_station->station_id;
        $shipment->to_station_id = $to_station->station_id;
        $shipment->shipment_mode = $request->shipment_mode;
        //$shipment->special_service = $request->special_service;
        //$shipment->special_service_description = $request->special_service_description;
        $shipment->return_package_cost = $request->return_package_cost;
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

        // $system_logs = new system_logs;
        // $system_logs->_id = $shipment->id;
        // $system_logs->category = 'shipment';
        // $system_logs->to_id = Auth::user()->email;
        // $system_logs->remark = 'New Shipment Created by Customer';
        // $system_logs->save();
        

        if($request->same_data == '0'){
            for ($x=0; $x<count($_POST['weight']); $x++) 
            {
                $shipment_package = new temp_shipment_package;
                $shipment_package->temp_id = $shipment->id;
                $shipment_package->category = $_POST['category'][$x];
                $shipment_package->reference_no = $_POST['reference_no'][$x];
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
                    $shipment_package = new temp_shipment_package;
                    $shipment_package->temp_id = $shipment->id;
                    $shipment_package->category = $_POST['category'][$x];
                    $shipment_package->reference_no = $_POST['reference_no'][$x];
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
        
        return response()->json('successfully save'); 
        //return $this->printLabel($shipment->id);
    }

    public function Shipment(){
        $language = language::all();
        return view('user.shipment',compact('language'));
    }

    public function viewShipment($id){
        $country = country::all();
        $agent = agent::all();
        $package_category = package_category::where('status',0)->get();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();

        $shipment =shipment::find($id);
        $user =User::find($shipment->sender_id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();
        $shipment_notes = shipment_notes::where('shipment_id',$id)->get();

        $system_logs = system_logs::where('_id',$id)->where('category','shipment')->get();

        $from_address =manage_address::find($shipment->from_address);
        $to_address =manage_address::find($shipment->to_address);
        $language = language::all();

        return view('user.view_shipment',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user','language','system_logs'));
    }

    public function getShipment(){
        $shipment = shipment::where('sender_id',Auth::user()->id)->orderBy('id', 'DESC')->get();

        return Datatables::of($shipment)
            ->addColumn('order_id', function ($shipment) {
                $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
                return '<td>'.$shipment_package[0]->sku_value.'</td>';
            })
            ->addColumn('shipment_type', function ($shipment) {
                if ($shipment->shipment_type == 1) {
                    return '<td>Pickup</td>';
                } else {
                    return '<td>Drop Off</td>';
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
                <p>' . date("d-m-Y",strtotime($shipment->shipment_date)) . '</p>
                <p>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</p>
                </td>';
            })
            ->addColumn('from_address', function ($shipment) {
                $from_address = manage_address::find($shipment->from_address);
                $from_city = city::find($from_address->city_id);
                $from_area = city::find($from_address->area_id);
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
                
                if(!empty($to_area)){
                return '<td>
                <p>' . $to_area->city . '</p>
                <p>' . $to_city->city . '</p>
                </td>';
                }
                else{
                    return '<td></td>';
                }
            })
            ->addColumn('status', function ($shipment) {
                $output='';
                if($shipment->status == 0){
                    $output.='Scheduled for Pickup';
                }
                elseif($shipment->status == 1){
                    $output.='Pickup Assigned';
                }
                elseif($shipment->status == 2){
                    $output.='Package Collected';
                }
                elseif($shipment->status == 3){
                    $output.='
                    <p>Pickup Exception</p>
                    <p>' . $shipment->exception_category . '</p>
                    <p>' . $shipment->exception_remark . '</p>
                    ';
                }
                elseif($shipment->status == 4){
                    $from_station = station::find($shipment->from_station_id);
                    $output.='Transit In '.$from_station->station;
                }
                elseif($shipment->status == 5){
                    $output.='Assign Agent to Transit Out (Hub)';
                }
                elseif($shipment->status == 6){
                    $to_station = station::find($shipment->to_station_id);
                    $output.='Transit Out '.$to_station->station;
                }
                elseif($shipment->status == 7){
                    $output.='In the Van for Delivery';
                }
                elseif($shipment->status == 8){
                    $output.='Shipment delivered';
                }
                elseif($shipment->status == 9){
                    $output.='
                    <p>Delivery Exception</p>
                    <p>' . $shipment->delivery_exception_category . '</p>
                    <p>' . $shipment->delivery_exception_remark . '</p>
                    ';
                }
                elseif($shipment->status == 10){
                    $output.='
                    <p>Canceled</p>
                    <p>' . $shipment->cancel_remark . '</p>
                    ';
                }

                if($shipment->hold_status == 1){
                    $output.='<p>Shipment Hold</p>';
                }
                return $output;

            })
            ->addColumn('action', function ($shipment) {
                $output='';
                if($shipment->hold_status == 0){
                    $output.='<a onclick="activeholdshipment('.$shipment->id.')" class="dropdown-item" href="#">Active Hold Shipment</a>';
                }
                elseif($shipment->hold_status == 1){
                    $output.='<a onclick="cancelholdshipment('.$shipment->id.')" class="dropdown-item" href="#">Cancel Hold Shipment</a>';
                }
                if($shipment->status == 8){
                    $output.='<a target="_blank" href="/user/print-invoice/'.$shipment->id.'" class="dropdown-item">Print</a>';
                }
                else{
                    $output.='
                    <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>
                    <a onclick="CancelRequest('.$shipment->id.')" class="dropdown-item" href="#">Shipment Cancel</a>
                    <a href="/user/view-shipment/'.$shipment->id.'" class="dropdown-item">View Shipment</a>
                    ';
                }
                return '<td>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(140px, 183px, 0px); top: 0px; left: 0px; will-change: transform;">
                        '.$output.'    
                    </div>
                </td>';
            })
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_type', 'shipment_mode','action','status'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function SaveCancelRequest(Request $request){
        $shipment = shipment::find($request->shipment_id);
        $shipment->cancel_remark = $request->cancel_remark;
        $shipment->cancel_request_date = date('Y-m-d');
        $shipment->cancel_request_time = date('H:i:s');
        $shipment->status = 10;
        $shipment->save();

        $system_logs = new system_logs;
        $system_logs->_id = $shipment->id;
        $system_logs->category = 'shipment';
        $system_logs->to_id = Auth::user()->email;
        $system_logs->remark = 'Cancel Shipment Created by Customer';
        $system_logs->save();

        return response()->json('successfully update'); 
    }

    public function activeHoldShipment($id){
        $shipment = shipment::find($id);
        $shipment->hold_status = 1;
        $shipment->save();

        $system_logs = new system_logs;
        $system_logs->_id = $shipment->id;
        $system_logs->category = 'shipment';
        $system_logs->to_id = Auth::user()->email;
        $system_logs->remark = 'Active Hold Shipment Created by Customer';
        $system_logs->save();

        return response()->json('successfully update'); 
    }

    public function cancelHoldShipment($id){
        $shipment = shipment::find($id);
        $shipment->hold_status = 0;
        $shipment->save();

        $system_logs = new system_logs;
        $system_logs->_id = $shipment->id;
        $system_logs->category = 'shipment';
        $system_logs->to_id = Auth::user()->email;
        $system_logs->remark = 'Cancel Hold Shipment Created by Customer';
        $system_logs->save();

        return response()->json('successfully update'); 
    }

    public function getAreaPrice($weight,$to_address,$shipment_mode,$special_service){
        $rate = add_rate::where('user_id',Auth::user()->id)->first();
        $address = manage_address::find($to_address);
        $area = city::find($address->area_id);
        $data =array();

        //$rate_item = add_rate_item::where('user_id',Auth::user()->id)->where('status',$shipment_mode)->get();
        $price=0;
        if($area->remote_area == '0'){
            if($special_service == '1'){
                if('0' <= $weight && '5' >= $weight){
                    $price = $rate->special_service_0_to_5_kg_price;
                }
                elseif('5.1' <= $weight && '10' >= $weight){
                    $price = $rate->special_service_5_to_10_kg_price;
                }
                elseif('10.1' <= $weight && '15' >= $weight){
                    $price = $rate->special_service_10_to_15_kg_price;
                }
                elseif('15.1' <= $weight && '20' >= $weight){
                    $price = $rate->special_service_15_to_20_kg_price;
                }
                elseif('20.1' <= $weight && '99999' >= $weight){
                    $price = (($weight - 20) * $rate->special_service_20_to_1000_kg_price) + $rate->special_service_15_to_20_kg_price; 
                }
            }
            else{
                if('0' <= $weight && '5' >= $weight && $shipment_mode == '1'){
                    $price = $rate->service_area_0_to_5_kg_price;
                }
                elseif('5.1' <= $weight && '10' >= $weight && $shipment_mode == '1'){
                    $price = $rate->service_area_5_to_10_kg_price;
                }
                elseif('10.1' <= $weight && '15' >= $weight && $shipment_mode == '1'){
                    $price = $rate->service_area_10_to_15_kg_price;
                }
                elseif('15.1' <= $weight && '20' >= $weight && $shipment_mode == '1'){
                    $price = $rate->service_area_15_to_20_kg_price;
                }
                elseif('20.1' <= $weight && '99999' >= $weight && $shipment_mode == '1'){
                    $price = (($weight - 20) * $rate->service_area_20_to_1000_kg_price) + $rate->service_area_15_to_20_kg_price; 
                }
                elseif('0' <= $weight && '5' >= $weight && $shipment_mode == '2'){
                    $price = $rate->same_day_delivery_0_to_5_kg_price;
                }
                elseif('5.1' <= $weight && '10' >= $weight && $shipment_mode == '2'){
                    $price = $rate->same_day_delivery_5_to_10_kg_price;
                }
                elseif('10.1' <= $weight && '15' >= $weight && $shipment_mode == '2'){
                    $price = $rate->same_day_delivery_10_to_15_kg_price;
                }
                elseif('15.1' <= $weight && '10' >= $weight && $shipment_mode == '2'){
                    $price = $rate->same_day_delivery_15_to_20_kg_price;
                }
                elseif('20.1' <= $weight && '999999' >= $weight && $shipment_mode == '2'){
                    $price = (($weight - 20) * $rate->same_day_delivery_20_to_1000_kg_price) + $rate->same_day_delivery_15_to_20_kg_price;
                }
            }
        }
        else{
            if('0' <= $weight && '5' >= $weight){
                $price = $rate->before_5_kg_price;
            }
            else{
                $price = (($weight - 5) * $rate->above_5_kg_price) + $rate->before_5_kg_price;
            }
        }


      
        $data['price'] = $price;
              

        return response()->json($data); 
    }



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
        $package_category = package_category::all();
        $user = User::find($shipment->sender_id);
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $from_address = manage_address::find($shipment->from_address);
        $to_address = manage_address::find($shipment->to_address);
        $view = view('print.printlabel',compact('shipment','shipment_package','country','city','area','from_address','to_address','shipment_count','all_shipments','package_category','user'))->render();

        // $pdf = PDF::loadView('print.printlabel',compact('shipment','shipment_package','country','city','area','from_address','to_address','shipment_count','all_shipments'));
        // //$path = public_path('pdfprint/');
        // $fileName =  $shipment->order_id . '.' . 'pdf' ;
        // //$pdf->save($path . '/' . $fileName);
        // return $pdf->stream('repot.pdf');

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
        $user = User::find($shipment->sender_id);
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $from_address = manage_address::find($shipment->from_address);
        $to_address = manage_address::find($shipment->to_address);

        $pdf = PDF::loadView('print.printinvoice',compact('shipment','shipment_package','country','city','area','from_address','to_address','shipment_count','all_shipments','customer','package_category','user'));
        $pdf->setPaper('A4');
        return $pdf->stream('report.pdf');
    }


    public function shipmentTrack(Request $request){
        $language = language::all();
        $id = $request->search_input;

        // $check1 = shipment_package::where('sku_value',$request->search_input)->first();
        $q =DB::table('shipment_packages as sp');
        $q->where('sp.sku_value', $request->search_input);
        $q->join('shipments as s','s.id','=','sp.shipment_id');
        $q->where('s.sender_id', Auth::user()->id);
        $q->select('s.*');
        $check1 = $q->get();

        $check2 = shipment::where('order_id',$request->search_input)->where('sender_id',Auth::user()->id)->first();
        $shipment_id='';
        if(!empty($check1)){
            $shipment_id = $check1[0]->id;
        }
        elseif(!empty($check2)){
            $shipment_id = $check2->id;
        }

        //$shipment = shipment::where('order_id',$request->search_input)->first();
        $shipment_logs = system_logs::where('_id',$shipment_id)->orderBy('id', 'DESC')->get();
        //return response()->json($shipment_logs);
      return view('user.shipment_track',compact('language','shipment_logs','id'));
    }


    public function searchFromAddress(){ 
        $data = manage_address::where('user_id',Auth::user()->id)->where('from_to',1)->get();
        $output ='<option value="">SELECT Address</option>';
        foreach ($data as $key => $value) {
            $output .= '<option value="'.$value->id.'">'.$value->contact_name.'-'.$value->contact_mobile.'-'.$value->address1.'</option>';
        }
        echo $output;
    }

    public function searchToAddress(){ 
        $data = manage_address::where('user_id',Auth::user()->id)->where('from_to',2)->get();
        $output ='<option value="">SELECT Address</option>';
        foreach ($data as $key => $value) {
            $output .= '<option value="'.$value->id.'">'.$value->contact_name.'-'.$value->contact_mobile.'-'.$value->address1.'</option>';
        }
        echo $output;
    }


    public function getAvailableTime($date){
        $date1 = date("l" , strtotime($date));
        $value = weeks::where('days',$date1)->first();
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        $today = date("l");
        $time = date("h:i A"); 
        $data = array();
        $output ='<option value="">SELECT Time</option>';
 
        $times = array('12:00 AM','01:00 AM','02:00 AM','03:00 AM','04:00 AM','05:00 AM','06:00 AM','07:00 AM','08:00 AM','09:00 AM','10:00 AM','11:00 AM','12:00 PM','01:00 PM','02:00 PM','03:00 PM','04:00 PM','05:00 PM','06:00 PM','07:00 PM','08:00 PM','09:00 PM','10:00 PM','11:00 PM');

        foreach($times as $row){
            if($value->status == '1'){
                if(strtotime($value->open_time) < strtotime($row)){
                    if($today == $value->days){
                        if(strtotime($time) < strtotime($row)){
                            if(strtotime($row) < strtotime($value->close_time)){
                                $output .= '<option value="'.$row.'">'.$row.'</option>';
                            }
                            // else{
                            //     $output .= '<option value="">Please Choose Other Date Or Kindly contact our customer service for alternative solution. +971569949409</option>';
                            //     break;
                            // }
                        }
                    }
                    else{
                        if(strtotime($row) < strtotime($value->close_time)){
                            $output .= '<option value="'.$row.'">'.$row.'</option>';
                        }
                    }
                }
            }
            else{
                $output .= '<option value="">'.$date1.' is Holiday Or Kindly contact our customer service for alternative solution. +971569949409</option>';
                break;
            }
        }

        if($output == '<option value="">SELECT Time</option>'){
            $output .= '<option value="">Please Choose Other Date Or Kindly contact our customer service for alternative solution. +971569949409</option>';
        }

        echo $output;
    }


}