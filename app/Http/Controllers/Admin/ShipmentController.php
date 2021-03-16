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
use App\Models\system_logs;
use App\Models\weeks;
use App\Models\complaint;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use DB;
use Mail;
use PDF;
use App\Http\Controllers\Admin\logController;

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
        $country = country::where('status',0)->get();
        $agent = agent::all();
        $package_category = package_category::where('status',0)->get();
        $city = city::where('parent_id',0)->where('status',0)->get();
        $area = city::where('parent_id','!=',0)->where('status',0)->get();
        $language = language::all();
        return view('admin.new_shipment',compact('drop_point','country','city','area','package_category','agent', 'language'));
    }

    public function specialShipment(){
        $drop_point = drop_point::all();
        $country = country::where('status',0)->get();
        $agent = agent::all();
        $package_category = package_category::where('status',0)->get();
        $city = city::where('parent_id',0)->where('status',0)->get();
        $area = city::where('parent_id','!=',0)->where('status',0)->get();
        $language = language::all();
        return view('admin.manual_shipment',compact('drop_point','country','city','area','package_category','agent', 'language'));
    }

    public function complaintShipment($id){
        $shipment1 = shipment_package::where('sku_value',$id)->first();
        $country = country::all();
        $agent = agent::all();
        $package_category = package_category::where('status',0)->get();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();

        $shipment =shipment::where('id',$shipment1->shipment_id)->first();
        $user =User::find($shipment->sender_id);
        $shipment_package = shipment_package::where('shipment_id',$shipment1->shipment_id)->get();
        $shipment_notes = shipment_notes::where('shipment_id',$shipment1->shipment_id)->get();

        $system_logs = system_logs::where('_id',$shipment1->shipment_id)->where('category','shipment')->get();

        $from_address =manage_address::find($shipment->from_address);
        $to_address =manage_address::find($shipment->to_address);
        $language = language::all();

        $arraytrackid=array();
        foreach($shipment_package as $row){
            $arraytrackid[] = $row->sku_value;
        }

        $complaint = complaint::whereIn('track_id',$arraytrackid)->get();

        return view('admin.view_shipment',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user','language','system_logs','complaint'));
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

        $arraytrackid=array();
        foreach($shipment_package as $row){
            $arraytrackid[] = $row->sku_value;
        }

        $complaint = complaint::whereIn('track_id',$arraytrackid)->get();

        return view('admin.view_shipment',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user','language','system_logs','complaint'));
    }

    public function saveShipmentNotes(Request $request){
        $shipment_notes = new shipment_notes;
        $shipment_notes->shipment_id = $request->shipment_id;
        $shipment_notes->admin_id = Auth::guard('admin')->user()->id;
        $shipment_notes->notes = $request->notes;
        $shipment_notes->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Shipment Notes '.$shipment_notes->shipment_id.'");

        return response()->json('successfully save'); 
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
        $system_logs = new system_logs;
        $system_logs->_id = $manage_address->id;
        $system_logs->category = 'address';
        $system_logs->to_id = Auth::guard('admin')->user()->email;
        $system_logs->remark = $manage_address->from_to == 1 ?'From Address':'To Address'.'Created By Employee';
        $system_logs->save();
        return response()->json($manage_address); 
    }

    public function saveNewShipment(Request $request){
        $this->validate($request, [
            'from_address'=>'required',
            'to_address'=>'required',
            'shipment_date'=>'required',
            'shipment_from_time'=>'required',
            'shipment_type'=>'required',
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
            'user_id'=> 'required',
            'total'=> 'required',
          ],[
            'from_address.required' => 'Choose From Address Field is Required',
            'to_address.required' => 'Choose To Address Field is Required',
            'shipment_type.required' => 'Pickup/Drop-Off Field is Required',
            //'price.*.required' => 'Price Field is Required',
            'user_id.required' => 'Please Choose Customer Field is Required',
        ]);

        $config = [
            'table' => 'shipments',
            'field' => 'order_id',
            'length' => 6,
            'prefix' => '0'
        ];

        $order_id = IdGenerator::generate($config);

        $from_address = manage_address::find($request->from_address);
        $from_station = city::find($from_address->city_id);

        $to_address = manage_address::find($request->to_address);
        $to_station = city::find($to_address->city_id);

        $shipment = new shipment;
        $shipment->order_id = $order_id;
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
        $shipment->special_service = $request->special_service;
        $shipment->special_service_description = $request->special_service_description;
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
        $shipment->reference_no = $request->reference_no;
        $shipment->identical = $request->same_data;
        $shipment->save();

        $system_logs = new system_logs;
        $system_logs->_id = $shipment->id;
        $system_logs->category = 'shipment';
        $system_logs->to_id = Auth::guard('admin')->user()->email;
        $system_logs->remark = 'New Shipment Created to '.Auth::guard('admin')->user()->name;
        $system_logs->save();

        $arrayshipment = array();
        $arrayshipment[] = $shipment->id;

        if($request->same_data == '0'){
            for ($x=0; $x<count($_POST['weight']); $x++) 
            {
                do {
                    $sku_value = mt_rand( 1000000000, 9999999999 );
                } 
                while ( DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists() );

                $shipment_package = new shipment_package;
                $shipment_package->sku_value = $sku_value;
                $shipment_package->shipment_id = $shipment->id;
                $shipment_package->category = $_POST['category'][$x];
               // $shipment_package->reference_no = $_POST['reference_no'][$x];
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
                        $sku_value = mt_rand( 1000000000, 9999999999 );
                    } 
                    while ( DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists() );
                    $shipment_package = new shipment_package;
                    $shipment_package->sku_value = $sku_value;
                    $shipment_package->shipment_id = $shipment->id;
                    $shipment_package->category = $_POST['category'][$x];
                    //$shipment_package->reference_no = $_POST['reference_no'][$x];
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

        if($request->return_package_cost == 1){
            $order_id1 = IdGenerator::generate($config);

            $from_address = manage_address::find($request->to_address);
            $from_station = city::find($from_address->city_id);

            $to_address = manage_address::find($request->from_address);
            $to_station = city::find($to_address->city_id);

            $shipment1 = new shipment;
            $shipment1->order_id = $order_id1;
            $shipment1->date = date('Y-m-d');
            $shipment1->sender_id = $request->user_id;
            $shipment1->shipment_type = $request->shipment_type;
            $shipment1->shipment_date = date('Y-m-d',strtotime($request->shipment_date));
            $shipment1->shipment_from_time = $request->shipment_from_time;
            $shipment1->shipment_to_time = $request->shipment_to_time;
            $shipment1->from_address = $request->to_address;
            $shipment1->to_address = $request->from_address;
            $shipment1->from_station_id = $to_station->station_id;
            $shipment1->to_station_id = $from_station->station_id;
            $shipment1->shipment_mode = $request->shipment_mode;
            $shipment1->special_service = $request->special_service;
            $shipment1->special_service_description = $request->special_service_description;
            $shipment1->return_package_cost = $request->return_package_cost;
            $shipment1->special_cod_enable = $request->special_cod_enable;
            $shipment1->special_cod = $request->special_cod;
            $shipment1->no_of_packages = $request->no_of_packages;
            $shipment1->declared_value = $request->declared_value;
            $shipment1->total_weight = $request->total_weight;
            $shipment1->shipment_price = $request->shipment_price;
            $shipment1->postal_charge_percentage = $request->postal_charge_percentage;
            $shipment1->postal_charge = $request->postal_charge;
            $shipment1->sub_total = $request->sub_total;
            $shipment1->vat_percentage = $request->vat_percentage;
            $shipment1->vat_amount = $request->vat_amount;
            $shipment1->insurance_percentage = $request->insurance_percentage;
            $shipment1->insurance_amount = $request->insurance_amount;
            $shipment1->before_total = $request->before_total;
            $shipment1->cod_amount = $request->cod_amount;
            $shipment1->total = $request->total;
            $shipment1->reference_no = $request->reference_no;
            $shipment1->identical = $request->same_data;
            $shipment1->save();

            $arrayshipment[] = $shipment1->id;

            $system_logs = new system_logs;
            $system_logs->_id = $shipment1->id;
            $system_logs->category = 'shipment';
            $system_logs->to_id = Auth::guard('admin')->user()->email;
            $system_logs->remark = 'New Shipment Created to '.Auth::guard('admin')->user()->name;
            $system_logs->save();

            if($request->same_data == '0'){
                for ($x=0; $x<count($_POST['weight']); $x++) 
                {
                    do {
                        $sku_value = mt_rand( 1000000000, 9999999999 );
                    } 
                    while ( DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists() );

                    $shipment_package = new shipment_package;
                    $shipment_package->sku_value = $sku_value;
                    $shipment_package->shipment_id = $shipment1->id;
                    $shipment_package->category = $_POST['category'][$x];
                // $shipment_package->reference_no = $_POST['reference_no'][$x];
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
                            $sku_value = mt_rand( 1000000000, 9999999999 );
                        } 
                        while ( DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists() );
                        $shipment_package = new shipment_package;
                        $shipment_package->sku_value = $sku_value;
                        $shipment_package->shipment_id = $shipment1->id;
                        $shipment_package->category = $_POST['category'][$x];
                        //$shipment_package->reference_no = $_POST['reference_no'][$x];
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
        }
        //echo($arrayshipment);
        if($request->return_package_cost == 1){
            return $this->bulkPrintLabel($arrayshipment,$request->user_id);
        }
        else{
            //return response()->json('successfully save'); 
            return $this->printLabel($shipment->id);
        }
        
    }


    public function Shipment(){
        $agent=agent::all();
        $language=language::all();
        return view('admin.shipment',compact('agent','language') );
    }

    public function assignAgent(Request $request){
        $agent=agent::find($request->pickup_agent_id);
        $shipment = shipment::find($request->shipment_id);
        $shipment->pickup_agent_id = $request->pickup_agent_id;
        $shipment->pickup_assign_date = date('Y-m-d');
        $shipment->pickup_assign_time = date('H:i:s');
        $shipment->status = 1;
        $shipment->save();
        $system_logs = new system_logs;
        $system_logs->_id = $shipment->id;
        $system_logs->category = 'shipment';
        $system_logs->to_id = Auth::guard('admin')->user()->email;
        $system_logs->remark = 'Pickup Assigned by Agent Id:'.$agent->agent_id.'/'.$agent->name.'/'.$agent->mobile.'/'.$agent->email;
        $system_logs->save();

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
        $language = language::all();

        return view('admin.pickup_station',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user','language'));
    }

    public function updatePickupStation(Request $request){
        $shipment = shipment::find($request->shipment_id);
        $shipment->package_collect_date = date('Y-m-d');
        $shipment->package_collect_time = date('H:i:s');
        $shipment->status = 4;
        $shipment->save();

        return response()->json('successfully update'); 
    }

    public function AssignAgentStation(Request $request){
        $shipment = shipment::find($request->shipment_id1);
        $shipment->station_agent_id = $request->station_agent_id;
        $shipment->station_assign_date = date('Y-m-d');
        $shipment->station_assign_time = date('H:i:s');
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

        $language = language::all();

        return view('admin.received_station',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user','language'));
    }

    public function updateReceivedStation(Request $request){
        $shipment = shipment::find($request->shipment_id);
        $shipment->station_received_date = date('Y-m-d');
        $shipment->station_received_time = date('H:i:s');
        $shipment->status = 6;
        $shipment->save();
        return response()->json('successfully update'); 
    }

    public function AssignAgentDelivery(Request $request){
        $shipment = shipment::find($request->shipment_id2);
        $shipment->van_scan_id = $request->delivery_agent_id;
        $shipment->van_scan_date = date('Y-m-d');
        $shipment->van_scan_time = date('H:i:s');
        $shipment->status = 7;
        $shipment->save();
        return response()->json('successfully update'); 
    }


    public function updateCancelRequest($id){
        $shipment = shipment::find($id);
        $shipment->canceled_date = date('Y-m-d');
        $shipment->canceled_time = date('H:i:s');
        $shipment->status = 11;
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

        $language = language::all();

        return view('admin.shipment_delivery',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user','language'));
    }

    public function updateShipmentDelivery(Request $request){
        $this->validate($request, [
            'receiver_id_copy' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'receiver_id_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
            'receiver_id_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
        ]);

        $shipment = shipment::find($request->shipment_id);
        $shipment->delivery_date = date('Y-m-d');
        $shipment->delivery_time = date('H:i:s');
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

        if(!empty($user)){
            Mail::send('mail.delivery_complete',compact('all','shipment_package','package_category'),function($message) use($user){
                $message->to($user->email)->subject('Well Well Express - Delivery Completed');
                $message->from('info@lrbinfotech.com','Well Well Express');
            });
        }

        return response()->json('successfully update'); 
    }

    public function getShipment($status,$fdate,$tdate){
        $fdate1 = date('Y-m-d', strtotime($fdate));
        $tdate1 = date('Y-m-d', strtotime($tdate));
        if(Auth::guard('admin')->user()->station_id == '0'){
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
            $i->where('shipments.hold_status',0);
            $i->orderBy('shipments.id','DESC');
            $shipment = $i->get();
        }
        else{
            //$shipment = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->orWhere('to_station_id',Auth::guard('admin')->user()->station_id)->orderBy('id','DESC')->where('hold_status',0)->get();
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
            $i->where('shipments.from_station_id',Auth::guard('admin')->user()->station_id);
            $i->orWhere('shipments.to_station_id',Auth::guard('admin')->user()->station_id);
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
                return '<td>'.date('h:i a',strtotime($shipment->shipment_from_time)).' to '.$shipment->shipment_to_time.'</td>';
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
            })
            ->addColumn('action', function ($shipment) {
                $output='';
                $output1='';
                //$role_get = role::find(Auth::guard('admin')->user()->role_id);
                if($shipment->status == 0){
                    $output.='<a onclick="AssignAgent('.$shipment->id.')" class="dropdown-item" href="#">Assign Agent</a>
                    <a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>';
                }
                elseif($shipment->status == 1){
                    $output.='<a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>';
                }
                elseif($shipment->status == 3){
                    $output.='<a onclick="PrintLabel('.$shipment->id.')" class="dropdown-item" href="#">Print Label</a>';
                }
                // elseif($shipment->status == 2){
                //     $output.='<a class="dropdown-item" href="/admin/pickup-station/'.$shipment->id.'">Received Station Hub</a>';
                // }
                // elseif($shipment->status == 4){
                //     if($shipment->from_station_id == $shipment->to_station_id){
                //         $output.='<a onclick="AssignAgentDelivery('.$shipment->id.')" class="dropdown-item">Agent Assign to Delivery</a>';
                //     }
                //     else{
                //         $output.='<a onclick="AssignAgentStation('.$shipment->id.')" class="dropdown-item">Assign Agent to Transit out (Hub)</a>';
                //     }
                // }
                // elseif($shipment->status == 5){
                //     $output.='<a href="/admin/received-station/'.$shipment->id.'" class="dropdown-item">Other Transit in Received (Hub)</a>';
                // }
                // elseif($shipment->status == 6){
                //     $output.='<a onclick="AssignAgentDelivery('.$shipment->id.')" class="dropdown-item">Agent Assign to Delivery</a>';
                // }
                // elseif($shipment->status == 7){
                //     $output.='<a href="/admin/shipment-delivery/'.$shipment->id.'" class="dropdown-item">Shipment Delivery</a>';
                // }

                if($shipment->status == 8){
                    $output1.='<a target="_blank" href="/admin/print-invoice/'.$shipment->id.'" class="dropdown-item">Print</a>';
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
            
        ->rawColumns(['order_id','shipment_date', 'from_address', 'to_address','shipment_time', 'shipment_mode','action','status','user_id'])
        ->addIndexColumn()
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }


    public function getAreaPrice($weight,$to_address,$shipment_mode,$user_id,$special_service){
        $rate = add_rate::where('user_id',$user_id)->first();
        $address = manage_address::find($to_address);
        $area = city::find($address->area_id);
        $data =array();

        //$rate_item = add_rate_item::where('user_id',$user_id)->where('status',$shipment_mode)->get();
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
            $price1=0;
            if($shipment_mode == '1'){
                $price1 = $rate->service_area_0_to_5_kg_price;
            }
            elseif($shipment_mode == '2'){
                $price1 = $rate->same_day_delivery_0_to_5_kg_price;
            }
            if('0' <= $weight && '5' >= $weight){
                $price = $rate->before_5_kg_price + $price1;
            }
            else{
                $price = (($weight - 5) * $rate->above_5_kg_price) + $rate->before_5_kg_price + $price1;
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


    public function getAgentShipment($id)
    {
        $shipment_count = shipment::where('pickup_agent_id',$id)->where('status',1)->count();

        $q =DB::table('shipments as s');
        $q->where('s.status', 1);
        $q->where('s.pickup_agent_id', $id);
        $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") , DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("SUM(s.total_weight) as total_weight") ]);
        $shipment = $q->first();

        return response()->json(['shipment'=>$shipment , 'shipment_count'=>$shipment_count]);
        //return response()->json($data); 
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

        return response()->json(['html'=>$view]);
    }

    public function bulkPrintLabel($id,$sender_id){
        $shipment = shipment::whereIn('id', $id)->get();
        $shipment_package = shipment_package::whereIn('shipment_id',$id)->get();

        $shipment_count = shipment_package::whereIn('shipment_id',$id)->count();

        $all_shipments = DB::table("shipment_packages as sp")
        ->whereIn("sp.shipment_id",$id)
        ->join('shipments as s', 's.id', '=', 'sp.shipment_id')
        ->join('stations as st', 'st.id', '=', 's.to_station_id')
        ->join('manage_addresses as fa', 'fa.id', '=', 's.from_address')
        ->join('manage_addresses as ta', 'ta.id', '=', 's.to_address')
        ->select('s.*','sp.shipment_id','sp.sku_value','sp.length','sp.width','sp.height','sp.category','sp.description','st.station','fa.city_id as from_city','fa.area_id as from_area','ta.city_id','ta.area_id','ta.address1','ta.address2','ta.address3','ta.contact_name','ta.contact_mobile','ta.contact_landline')
        //->groupBy("users.id")
        ->get();

        $country = country::all();
        $package_category = package_category::all();
        $user = User::find($sender_id);
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $view = view('print.bulkprintlabel',compact('shipment','shipment_package','country','city','area','shipment_count','all_shipments','package_category','user'))->render();

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
        $user = User::find($shipment->sender_id);
        $package_category = package_category::all();
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

        $check1 = shipment_package::where('sku_value',$request->search_input)->first();
        $check2 = shipment::where('order_id',$request->search_input)->first();
        $check3 = shipment::where('reference_no',$request->search_input)->first();
        $shipment_id='';
        if(!empty($check1)){
            $shipment_id = $check1->shipment_id;
        }
        elseif(!empty($check2)){
            $shipment_id = $check2->id;
        }
        elseif(!empty($check3)){
            $shipment_id = $check3->id;
        }

        $country = country::all();
        $agent = agent::all();
        $package_category = package_category::where('status',0)->get();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();

        $shipment =shipment::find($shipment_id);
        

        if(!empty($shipment)){
            $user =User::find($shipment->sender_id);
            $shipment_package = shipment_package::where('shipment_id',$shipment_id)->get();
            $shipment_notes = shipment_notes::where('shipment_id',$shipment_id)->get();

            $system_logs = system_logs::where('_id',$shipment_id)->where('category','shipment')->get();

            $from_address =manage_address::find($shipment->from_address);
            $to_address =manage_address::find($shipment->to_address);
            $language = language::all();

            $arraytrackid=array();
            foreach($shipment_package as $row){
                $arraytrackid[] = $row->sku_value;
            }

            $complaint = complaint::whereIn('track_id',$arraytrackid)->get();

            return view('admin.view_shipment',compact('country','city','area','package_category','agent','shipment','shipment_package','shipment_notes','from_address','to_address','user','language','system_logs','complaint'));
        }
        else{
            $shipment_logs = system_logs::where('_id',$shipment_id)->orderBy('id', 'DESC')->get();
            return view('admin.shipment_track',compact('language','shipment_logs','id'));
        }

        //$shipment = shipment::where('order_id',$request->search_input)->first();
        //$shipment_logs = system_logs::where('_id',$shipment_id)->orderBy('id', 'DESC')->get();
        //return response()->json($shipment_logs);
      //return view('admin.shipment_track',compact('language','shipment_logs','id'));
    }



    public function searchFromAddress($id){ 
        $data = manage_address::where('user_id',$id)->where('from_to',1)->get();
        $output ='<option value="">SELECT Address</option>';
        foreach ($data as $key => $value) {
            $output .= '<option value="'.$value->id.'">'.$value->contact_name.'-'.$value->contact_mobile.'-'.$value->address1.'</option>';
        }
        echo $output;
    }

    public function searchToAddress($id){ 
        $data = manage_address::where('user_id',$id)->where('from_to',2)->get();
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
