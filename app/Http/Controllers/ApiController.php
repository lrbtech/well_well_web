<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agent;
use App\Models\city;
use App\Models\User;
use App\Models\shipment;
use App\Models\shipment_package;
use App\Models\station;
use App\Models\manage_address;
use App\Models\package_category;
use App\Models\exception_category;
use App\Models\country;
use Hash;
use Mail;
use PDF;
use DB;

class ApiController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }
    public function agentLogin(Request $request){
        $exist = agent::where('email',$request->email)->get();
        if(count($exist)>0){
            //if($exist[0]->status == 1){
                if(Hash::check($request->password,$exist[0]->password)){
                    $agent = agent::find($exist[0]->id);
                    $agent->firebase_key = $request->firebase_key;
                    $agent->save();

                return response()->json(['message' => 'Login Successfully',
                'name'=>$exist[0]->name,
                'pickup'=>$exist[0]->pickup,
                'delivery'=>$exist[0]->delivery,
                'revenue_exception'=>$exist[0]->revenue_exception,
                'cash_report'=>$exist[0]->cash_report,
                'hub'=>$exist[0]->hub,
                'van_scan'=>$exist[0]->van_scan,
                'agent_id'=>$exist[0]->id,'status'=>200], 200);
                }else{
                    return response()->json(['message' => 'Records Does not Match','status'=>403], 403);
                }
            // }else{
            //     return response()->json(['message' => 'Verify Your Account','status'=>401,'agent_id'=>$exist[0]->id], 401);
            // }
        }else{
            return response()->json(['message' => 'This Email Address Not Registered','status'=>404], 404);
        }
    }

    public function getPickup($agent_id){
        $shipment = shipment::where('pickup_agent_id',$agent_id)->where('status',1)->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $data = array(
                'id' => $value->id,
                'order_id' => $value->order_id,
                'shipment_mode' => $value->shipment_mode,
                'shipment_date' => $value->shipment_date,
                'shipment_from_time' => $value->shipment_from_time,
                //'shipment_to_time' => $value->shipment_to_time,
                'address1' => '',
                'address2' => '',
                'address3' => '',
                'city' => '',
                'area' => '',
                'name' => '',
                'mobile' => '',
            );
            $address = manage_address::find($value->from_address);
            $city = city::find($address->city_id);
            $area = city::find($address->area_id);

            $user = User::find($value->sender_id);
            if(!empty($user)){
                if($user->user_type == '0'){
                    $data['name'] = $user->first_name . $user->last_name;
                }
                else{
                    $data['name'] = $user->business_name;
                }
                $data['mobile'] = $user->mobile;
            }
            else{
                $data['name'] = $address->contact_name;
            }
            
            if(!empty($address->address1)){
                $data['address1'] = $address->address1;
            }
            if(!empty($address->address2)){
                $data['address2'] = $address->address2;
            }
            if(!empty($address->address3)){
                $data['address3'] = $address->address3;
            }
            if(empty($city)){
                $data['city'] = $city->city;
            }
            if(!empty($area)){
                $data['area'] = $area->city;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getDelivery($agent_id){
        $shipment = shipment::where('delivery_agent_id',$agent_id)->where('status',7)->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $data = array(
                'id' => $value->id,
                'order_id' => $value->order_id,
                'shipment_mode' => $value->shipment_mode,
                'shipment_date' => $value->shipment_date,
                'shipment_from_time' => $value->shipment_from_time,
                //'shipment_to_time' => $value->shipment_to_time,
                'address1' => '',
                'address2' => '',
                'address3' => '',
                'city' => '',
                'area' => '',
                'name' => '',
                'mobile' => '',
            );
            $address = manage_address::find($value->to_address);
            $city = city::find($address->city_id);
            $area = city::find($address->area_id);

            $user = User::find($value->sender_id);
            if(!empty($user)){
                if($user->user_type == '0'){
                    $data['name'] = $user->first_name . $user->last_name;
                }
                else{
                    $data['name'] = $user->business_name;
                }
                $data['mobile'] = $user->mobile;
            }
            else{
                $data['name'] = $address->contact_name;
            }
            if(!empty($address->address1)){
                $data['address1'] = $address->address1;
            }
            if(!empty($address->address2)){
                $data['address2'] = $address->address2;
            }
            if(!empty($address->address3)){
                $data['address3'] = $address->address3;
            }
            if(empty($city)){
                $data['city'] = $city->city;
            }
            if(!empty($area)){
                $data['area'] = $area->city;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getStation($agent_id){
        $shipment = shipment::where('station_agent_id',$agent_id)->where('status',5)->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_station = station::find($value->from_station_id);
            $to_station = station::find($value->to_station_id);
            $data = array(
                'id' => $value->id,
                'order_id' => $value->order_id,
                'from_station' => $from_station->station,
                'to_station' => $to_station->station,
                'date_time' => $value->station_assign_date_time,
            );
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getShipmentPacakgae($id){
        $shipment_package = shipment_package::where('shipment_id',$id)->get();

        $data =array();
        $datas =array();
        foreach ($shipment_package as $key => $value) {
            $category = package_category::find($value->category);
            $data = array(
                'id' => $value->id,
                'category' => $category->category,
                'description' => $value->description,
                'weight' => $value->weight,
                'length' => $value->length,
                'width' => $value->width,
                'height' => $value->height,
                'price' => $value->chargeable_weight,
                'barcode_package' => $value->barcode_package,
            );
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getPickupDetails($id){
        $shipment = shipment::find($id);
        $data =array();
        $data = array(
            'id' => $shipment->id,
            'order_id' => $shipment->order_id,
            'shipment_mode' => $shipment->shipment_mode,
            'shipment_date' => $shipment->shipment_date,
            'shipment_from_time' => $shipment->shipment_from_time,
            //'shipment_to_time' => $shipment->shipment_to_time,
            'address1' => '',
            'address2' => '',
            'address3' => '',
            'latitude' => '',
            'longitude' => '',
            'city' => '',
            'area' => '',
            'name' => '',
            'mobile' => '',
            'printpdf' => '',
            'shipment_price' => $shipment->shipment_price,
            'no_of_packages' => $shipment->no_of_packages,
            'declared_value' => $shipment->declared_value,
            'total' => $shipment->total,
            'sub_total' => $shipment->sub_total,
            'postal_charge_percentage' => '',
            'postal_charge' => '',
            'vat_percentage' => '',
            'vat_amount' => '',
            'insurance_percentage' => '',
            'insurance_amount' => '',
            'cod_amount' => '',
        );
        if($shipment->pdf_print != 'null'){
            $data['printpdf'] = $shipment->pdf_print;
        }
        if($shipment->postal_charge_percentage != 'null'){
            $data['postal_charge_percentage'] = $shipment->postal_charge_percentage;
            $data['postal_charge'] = $shipment->postal_charge;
        }
        if($shipment->vat_percentage != 'null'){
            $data['vat_percentage'] = $shipment->vat_percentage;
            $data['vat_amount'] = $shipment->vat_amount;
        }
        if($shipment->insurance_percentage != 'null'){
            $data['insurance_percentage'] = $shipment->insurance_percentage;
            $data['insurance_amount'] = $shipment->insurance_amount;
        }
        if($shipment->cod_amount != 'null'){
            $data['cod_amount'] = $shipment->cod_amount;
        }
        $address = manage_address::find($shipment->from_address);
        $city = city::find($address->city_id);
        $area = city::find($address->area_id);

        $user = User::find($shipment->sender_id);
        if(!empty($user)){
            if($user->user_type == '0'){
                $data['name'] = $user->first_name . $user->last_name;
            }
            else{
                $data['name'] = $user->business_name;
            }
            $data['mobile'] = $user->mobile;
        }
        else{
            $data['name'] = $address->contact_name;
        }
        if(!empty($address->address1)){
            $data['address1'] = $address->address1;
        }
        if(!empty($address->address2)){
            $data['address2'] = $address->address2;
        }
        if(!empty($address->address3)){
            $data['address3'] = $address->address3;
        }
        if(!empty($address->latitude)){
            $data['latitude'] = $address->latitude;
        }
        if(!empty($address->longitude)){
            $data['longitude'] = $address->longitude;
        }
        if(!empty($city)){
            $data['city'] = $city->city;
        }
        if(!empty($area)){
            $data['area'] = $area->city;
        }
        return response()->json($data); 
    }


    public function getDeliveryDetails($id){
        $shipment = shipment::find($id);

        $data = array(
            'id' => $shipment->id,
            'order_id' => $shipment->order_id,
            'shipment_mode' => $shipment->shipment_mode,
            'shipment_date' => $shipment->shipment_date,
            'shipment_from_time' => $shipment->shipment_from_time,
            //'shipment_to_time' => $shipment->shipment_to_time,
            'address1' => '',
            'address2' => '',
            'address3' => '',
            'latitude' => '',
            'longitude' => '',
            'city' => '',
            'area' => '',
            'name' => '',
            'mobile' => '',
            'special_cod' => '',
            'shipment_price' => $shipment->shipment_price,
            'no_of_packages' => $shipment->no_of_packages,
            'declared_value' => $shipment->declared_value,
            'total' => $shipment->total,
            'sub_total' => $shipment->sub_total,
            'postal_charge_percentage' => '',
            'postal_charge' => '',
            'vat_percentage' => '',
            'vat_amount' => '',
            'insurance_percentage' => '',
            'insurance_amount' => '',
            'cod_amount' => '',
            'from_station' => '',
            'to_station' => '',
        );

        $from_station = station::find($shipment->from_station_id);
        $to_station = station::find($shipment->to_station_id);
            
        if(!empty($from_station)){
            $data['from_station'] = $from_station->station;
        }
        if(!empty($to_station)){
            $data['to_station'] = $to_station->station;
        }
        if($shipment->special_cod_enable == '1'){
            $data['special_cod'] = $shipment->special_cod;
        }
        if($shipment->postal_charge_percentage != 'null'){
            $data['postal_charge_percentage'] = $shipment->postal_charge_percentage;
            $data['postal_charge'] = $shipment->postal_charge;
        }
        if($shipment->vat_percentage != 'null'){
            $data['vat_percentage'] = $shipment->vat_percentage;
            $data['vat_amount'] = $shipment->vat_amount;
        }
        if($shipment->insurance_percentage != 'null'){
            $data['insurance_percentage'] = $shipment->insurance_percentage;
            $data['insurance_amount'] = $shipment->insurance_amount;
        }
        if($shipment->cod_amount != 'null'){
            $data['cod_amount'] = $shipment->cod_amount;
        }
        $address = manage_address::find($shipment->to_address);
        $city = city::find($address->city_id);
        $area = city::find($address->area_id);

        $user = User::find($shipment->sender_id);
        if(!empty($user)){
            if($user->user_type == '0'){
                $data['name'] = $user->first_name . $user->last_name;
            }
            else{
                $data['name'] = $user->business_name;
            }
            $data['mobile'] = $user->mobile;
        }
        else{
            $data['name'] = $address->contact_name;
        }
        if(!empty($address->longitude)){
            $data['longitude'] = $address->longitude;
        }
        if(!empty($city)){
            $data['city'] = $city->city;
        }
        if(!empty($area)){
            $data['area'] = $area->city;
        }
        return response()->json($data); 
    }


    public function updatePickup(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            if($request->status == 0){
                $shipment->status = 2;
                $shipment->package_collect_date = date('Y-m-d');
                $shipment->package_collect_time = date('H:i:s');
                
            }
            else{
                $shipment->status = 3;
                $shipment->exception_category = $request->category;
                $shipment->exception_remark = $request->remark;
                $shipment->exception_assign_date = date('Y-m-d');
                $shipment->exception_assign_time = date('H:i:s');
            }
            $shipment->save();
            

           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function transistIn(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            
            $shipment->status = 4;
            $shipment->pickup_received_date = date('Y-m-d');
            $shipment->pickup_received_time = date('H:i:s');
            $shipment->save();

           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function transistOut(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            
            $shipment->status = 6;
            $shipment->station_received_date = date('Y-m-d');
            $shipment->station_received_time = date('H:i:s');
            $shipment->save();

           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function packageAtStation(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            
            $shipment->status = 6;
            $shipment->save();

           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function vanScan(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            
            $shipment->status = 7;
            $shipment->delivery_agent_id = $request->agent_id;
            $shipment->delivery_assign_date = date('Y-m-d');
            $shipment->delivery_assign_time = date('H:i:s');
            $shipment->save();

           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function updateDelivery(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            $shipment->status = 8;
            $shipment->delivery_date = date('Y-m-d');
            $shipment->delivery_time = date('H:i:s');

            $shipment->cod_type = $request->cod_type;
            $shipment->collect_cod_amount = $request->cod_amount;
            $shipment->delivery_notes = $request->delivery_notes;

            $shipment->receiver_signature = 'data:image/png;base64,'.$request->receiver_signature;
            
            // if(isset($request->receiver_id_copy)){
            //     if($request->receiver_id_copy!=""){                
            //         $image = $request->receiver_id_copy;
            //         $image_name = $request->receiver_id_copy_name;
            //         $filename1='';
            //         foreach(explode('.', $image_name) as $info){
            //             $filename1 = $info;
            //         }
            //         $fileName = rand() . '.' . $filename1;
    
            //         $realImage = base64_decode($image);
            //         file_put_contents(public_path().'/upload_files/'.$fileName, $realImage);    
            //     $shipment->receiver_id_copy =  $fileName;
    
            //   }
            // }


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
            

           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function deliveryException(Request $request){
        try{
            $shipment = shipment::find($request->shipment_id);
            
            $shipment->status = 9;
            $shipment->delivery_exception_category = $request->category;
            $shipment->delivery_exception_remark = $request->remark;
            $shipment->delivery_exception_assign_date = date('Y-m-d');
            $shipment->delivery_exception_assign_time = date('H:i:s');
            $shipment->save();
            
           // return response()->json($shipment);
            return response()->json(
                ['message' => 'Update Successfully',
                'shipment_id'=>$shipment->id,
                ],200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }



    public function changePassword(Request $request){
        $agent = agent::find($request->agent_id);
        $hashedPassword = $agent->password;
 
        if (\Hash::check($request->oldpassword , $hashedPassword )) {
            if (!\Hash::check($request->password , $hashedPassword)) {
                $agent->password = Hash::make($request->password);
                $agent->save();
                return response()->json(['message' => 'Successfully Update'], 200);
            }
            else{
                return response()->json(['message' => 'new password can not be the old password!','status'=>400], 400);
            }
        }
        else{
            return response()->json(['message' => 'old password doesnt matched','status'=>400], 400);
        }
    }

    public function scanPackage(Request $request){ 
        //return response()->json($request);
        try{
            $exist = shipment::where('order_id',$request->order_id)->get();
        //return response()->json(count($exist));
        if(count($exist)>0){
        // $pickup = shipment::where('order_id',$exist[0]->order_id)->where('pickup_agent_id',$request->agent_id)->where('status',1)->first();

        // $delivery = shipment::where('order_id',$exist[0]->order_id)->where('delivery_agent_id',$request->agent_id)->where('status',7)->first();
            foreach($exist as $row){
                if($row->pickup_agent_id == $request->agent_id && $row->status == 1){
                    return response()->json(['message' => 'Successfully Send','shipment_id'=>$row->id,'status'=>0], 200);
                }
                elseif($row->delivery_agent_id == $request->agent_id && $row->status == 7){
                    return response()->json(['message' => 'Successfully Send','shipment_id'=>$row->id,'status'=>1], 200);
                }
                else{
                    return response()->json(['message' => 'Status Not Available','status'=>400], 400);
                }
            }


        
            }else{
                return response()->json(['message' => 'Shipment Not Available','status'=>403], 403);
            }
        
        }catch (\Exception $e) {
            return response()->json($e);
            return response()->json(['message' => 'Shipment Not Available','status'=>200], 200);
        }
    }


    public function barcodeScan(Request $request){ 
        //return response()->json($request);
        try{
            $check1 = shipment_package::where('barcode_package',$request->barcode)->first();
            $check2 = shipment::where('order_id',$request->barcode)->first();
            $shipment_id='';
            if(!empty($check1)){
                $shipment_id = $check1->shipment_id;
            }
            elseif(!empty($check2)){
                $shipment_id = $check2->id;
            }
            
            $shipment = shipment::find($shipment_id);
            
            return response()->json([
            'no_of_packages'=>$shipment->no_of_packages,
            'shipment_id'=>$shipment->order_id,
            'id'=>$shipment->id,
            'status'=>$shipment->status,
            ], 200);
        
        }catch (\Exception $e) {
            return response()->json($e);
            return response()->json(['message' => 'Shipment Not Available','status'=>200], 200);
        }
    }


    public function mobilePrintLabel($id){
        $shipment = shipment::find($id);
        $shipment_package = shipment_package::where('shipment_id',$id)->get();

        $shipment_count = shipment_package::where('shipment_id',$id)->count();

        $all_shipments = DB::table("shipment_packages as sp")
        ->where("sp.shipment_id",$id)
        ->join('shipments as s', 's.id', '=', 'sp.shipment_id')
        ->join('stations as st', 'st.id', '=', 's.to_station_id')
        ->select('s.*','sp.barcode_package','sp.length','sp.width','sp.height','st.station')
        //->groupBy("users.id")
        ->get();

        $country = country::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $from_address = manage_address::find($shipment->from_address);
        $to_address = manage_address::find($shipment->to_address);

        $pdf = PDF::loadView('print.mobile_print_label',compact('shipment','shipment_package','country','city','area','from_address','to_address','shipment_count','all_shipments'));
        $pdf->setPaper('A4');
        return $pdf->stream('report.pdf');

        // $view = view('print.printlabel',compact('shipment','shipment_package','country','city','area','from_address','to_address','shipment_count','all_shipments'))->render();

        // return response()->json($view);
    }


    public function exceptionCategory(){
        $exception_category = exception_category::all();
        $datas =array();
        foreach ($exception_category as $key => $value) {
            $datas[] = $value->category;
        }   
        return response()->json($datas); 
    }


    public function getTodayStation(){
        $today = date('Y-m-d');
        $shipment = shipment::where('date',$today)->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_station = station::find($value->from_station_id);
            $to_station = station::find($value->to_station_id);
            $data = array(
                'id' => $value->id,
                'order_id' => $value->order_id,
                'from_station' => $from_station->station,
                'to_station' => $to_station->station,
                'status' => '',
            );
            if($value->status == 0){
                $data['status'] = 'New Request';
            }
            elseif($value->status == 1){
                $data['status'] = 'Approved';
            }
            elseif($value->status == 2){
                $data['status'] = 'Package Collected';
            }
            elseif($value->status == 3){
                $data['status'] = 'Exception';
            }
            elseif($value->status == 4){
                $data['status'] = 'Received Station Hub';
            }
            elseif($value->status == 5){
                $data['status'] = 'Assign Agent to Transit Out (Hub)';
            }
            elseif($value->status == 6){
                $data['status'] = 'Other Transit in Received (Hub)';
            }
            elseif($value->status == 7){
                $data['status'] = 'Assign Agent to Delivery';
            }
            elseif($value->status == 8){
                $data['status'] = 'Shipment delivered';
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getTodayData(){
        $today = date('Y-m-d');
        $total_shipment = shipment::where('date',$today)->count();

        $total_shipment_value = shipment::where('date', $today)->get()->sum("total");

        $collected_value = shipment::where('date', $today)->where('status',8)->get()->sum("special_cod");

        $on_pickup = shipment::where('pickup_assign_date',$today)->where('status',1)->count();

        $pickup = shipment::where('package_collect_date',$today)->where('status',2)->count();

        $exception = shipment::where('exception_assign_date',$today)->where('status',3)->count();

        $hub = shipment::where('station_assign_date',$today)->where('status',4)->count();

        $delivery = shipment::where('delivery_assign_date',$today)->where('status',7)->count();
        $completed = shipment::where('delivery_date',$today)->where('status',8)->count();

        $data = array(
            'total_shipment' => $total_shipment,
            'total_shipment_value' => $total_shipment_value,
            'collected_value' => $collected_value,
            'on_pickup' => $on_pickup,
            'pickup' => $pickup,
            'exception' => $exception,
            'hub' => $hub,
            'delivery' => $delivery,
            'completed' => $completed,
        );
   
        return response()->json($data); 
    }


    public function getExceptionShipment(){
        $today = date('Y-m-d');
        $shipment = shipment::where('status',3)->orWhere('status',9)->get();

        $data =array();
        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_station = station::find($value->from_station_id);
            $to_station = station::find($value->to_station_id);
            $data = array(
                'id' => $value->id,
                'order_id' => $value->order_id,
                'from_station' => $from_station->station,
                'to_station' => $to_station->station,
            );
            
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getExceptionDetails($id){
        $today = date('Y-m-d');
        $shipment = shipment::find($id);

        if($shipment->status == '3'){
            if($shipment->exception_category != null){
                $data['exception_category'] = $shipment->exception_category;
            }
            if($shipment->exception_remark != null){
                $data['exception_remark'] = $shipment->exception_remark;
            }
        }
        elseif($shipment->status == '9'){
            if($shipment->delivery_exception_category != null){
                $data['exception_category'] = $shipment->delivery_exception_category;
            }
            if($shipment->delivery_exception_remark != null){
                $data['exception_remark'] = $shipment->delivery_exception_remark;
            }
        }

        return response()->json($data); 
    }



    public function printTodayData(){
        $today = date('Y-m-d');
        $total_shipment = shipment::where('date',$today)->count();

        $total_shipment_value = shipment::where('date', $today)->get()->sum("total");

        $collected_value = shipment::where('date', $today)->where('status',8)->get()->sum("special_cod");

        $on_pickup = shipment::where('pickup_assign_date',$today)->where('status',1)->count();

        $pickup = shipment::where('package_collect_date',$today)->where('status',2)->count();

        $exception = shipment::where('exception_assign_date',$today)->where('status',3)->count();

        $hub = shipment::where('station_assign_date',$today)->where('status',4)->count();

        $delivery = shipment::where('delivery_assign_date',$today)->where('status',7)->count();
        $completed = shipment::where('delivery_date',$today)->where('status',8)->count();

        $shipment = shipment::where('date',$today)->get();

        $datas =array();
        foreach ($shipment as $key => $value) {
            $from_station = station::find($value->from_station_id);
            $to_station = station::find($value->to_station_id);
            $data = array(
                'id' => $value->id,
                'order_id' => $value->order_id,
                'from_station' => $from_station->station,
                'to_station' => $to_station->station,
                'status' => '',
            );
            if($value->status == 0){
                $data['status'] = 'New Request';
            }
            elseif($value->status == 1){
                $data['status'] = 'Approved';
            }
            elseif($value->status == 2){
                $data['status'] = 'Package Collected';
            }
            elseif($value->status == 3){
                $data['status'] = 'Exception';
            }
            elseif($value->status == 4){
                $data['status'] = 'Received Station Hub';
            }
            elseif($value->status == 5){
                $data['status'] = 'Assign Agent to Transit Out (Hub)';
            }
            elseif($value->status == 6){
                $data['status'] = 'Other Transit in Received (Hub)';
            }
            elseif($value->status == 7){
                $data['status'] = 'Assign Agent to Delivery';
            }
            elseif($value->status == 8){
                $data['status'] = 'Shipment delivered';
            }
            $datas[] = $data;
        }   

        $shipment_data = array(
            'total_shipment' => $total_shipment,
            'total_shipment_value' => $total_shipment_value,
            'collected_value' => $collected_value,
            'on_pickup' => $on_pickup,
            'pickup' => $pickup,
            'exception' => $exception,
            'hub' => $hub,
            'delivery' => $delivery,
            'completed' => $completed,
        );
   
        $pdf = PDF::loadView('print.mobile_today_data',compact('shipment_data','datas'));
        $pdf->setPaper('A4');
        return $pdf->stream('report.pdf');
    }




}
