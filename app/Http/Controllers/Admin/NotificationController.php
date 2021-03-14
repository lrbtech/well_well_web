<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\push_notification;
use App\Models\agent;
use App\Models\User;
use App\Models\language;
use App\Models\role;
use Hash;
use Auth;
use App\Http\Controllers\Admin\logController;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function saveNotification(Request $request){
        $request->validate([
            'title'=>'required',
        ]);

        $agent_id='';
        if($request->send_to == '3'){
            $agent1;
            foreach($request->agent_id as $row){
                $agent1[]=$row;
            }
            $agent_id = collect($agent1)->implode(',');
        }

        $customer_id='';
        if($request->send_to == '4'){
            $customer1;
            foreach($request->customer_id as $row){
                $customer1[]=$row;
            }
            $customer_id = collect($customer1)->implode(',');
        }

        $push_notification = new push_notification;
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->expiry_date = $request->expiry_date;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '4'){
            $push_notification->customer_ids = $customer_id;
        }
        if($request->send_to == '3'){
            $push_notification->agent_ids = $agent_id;
        }

        $push_notification->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Push Notification : '.$push_notification->title.'");

        return response()->json('successfully save'); 
    }

    public function saveSendNotification(Request $request){
        $request->validate([
            'title'=>'required',
        ]);

        $agent_id='';
        if($request->send_to == '3'){
            $agent1;
            foreach($request->agent_id as $row){
                $agent1[]=$row;
            }
            $agent_id = collect($agent1)->implode(',');
        }
        $customer_id='';
        if($request->send_to == '4'){
            $customer1;
            foreach($request->customer_id as $row){
                $customer1[]=$row;
            }
            $customer_id = collect($customer1)->implode(',');
        }
        $push_notification = new push_notification;
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->expiry_date = $request->expiry_date;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '4'){
            $push_notification->customer_ids = $customer_id;
        }
        if($request->send_to == '3'){
            $push_notification->agent_ids = $agent_id;
        }
        $push_notification->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Push & Send Notification : '.$push_notification->title.'");

        $this->sendNotification($push_notification->id);
        return response()->json('successfully save'); 
    }

    public function updateNotification(Request $request){
        $request->validate([
            'title'=> 'required',
        ]);
        
        $agent_id='';
        if($request->send_to == '3'){
            $agent1;
            foreach($request->agent_id as $row){
                $agent1[]=$row;
            }
            $agent_id = collect($agent1)->implode(',');
        }
        $customer_id='';
        if($request->send_to == '4'){
            $customer1;
            foreach($request->customer_id as $row){
                $customer1[]=$row;
            }
            $customer_id = collect($customer1)->implode(',');
        }
        $push_notification = push_notification::find($request->id);
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->expiry_date = $request->expiry_date;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '4'){
            $push_notification->customer_ids = $customer_id;
        }
        if($request->send_to == '3'){
            $push_notification->agent_ids = $agent_id;
        }
        $push_notification->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Push Notification : '.$push_notification->title.'");

        return response()->json('successfully update'); 
    }

    public function updateSendNotification(Request $request){
        $request->validate([
            'title'=> 'required',
        ]);
        
        $agent_id='';
        if($request->send_to == '3'){
            $agent1;
            foreach($request->agent_id as $row){
                $agent1[]=$row;
            }
            $agent_id = collect($agent1)->implode(',');
        }
        $customer_id='';
        if($request->send_to == '4'){
            $customer1;
            foreach($request->customer_id as $row){
                $customer1[]=$row;
            }
            $customer_id = collect($customer1)->implode(',');
        }
        $push_notification = push_notification::find($request->id);
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->expiry_date = $request->expiry_date;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '4'){
            $push_notification->customer_ids = $customer_id;
        }
        if($request->send_to == '3'){
            $push_notification->agent_ids = $agent_id;
        }
        $push_notification->save();

        $this->sendNotification($push_notification->id);

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit & Send Push Notification : '.$push_notification->title.'");

        return response()->json('successfully update'); 
    }

    public function Notification(){
        $push_notification = push_notification::all();
        $agent = agent::all();
        $user = User::where('status',4)->get();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.push_notification',compact('push_notification','agent','language','user','role_get'));
    }

    public function editNotification($id){
        $push_notification = push_notification::find($id);
        return response()->json($push_notification); 
    }
    
    public function deleteNotification($id){
        $push_notification = push_notification::find($id);
        $push_notification->delete();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Push Notification : '.$push_notification->title.'");

        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function sendNotification($id){
        //$body = "Pickup date/time : ".$request->pickup_date.'/'.$request->pickup_time.' Delivery Type :'.$request->delivery_option;
        $push_notification = push_notification::find($id);

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Send Push Notification : '.$push_notification->title.'");

        if($push_notification->send_to == '1'){
            $agent = agent::where('firebase_key','!=',null)->get();
            foreach($agent as $agent1){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$agent1->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAA8MuJ8ds:APA91bG2jOF4RQMoEu_sThruub8PeCu6SYjOOBA1Ba1TNd561DK9OPfqnEZS1GlD5BFfDvDsZBwkbCltNbfNU0Z3IO1emZniEYGuGPSmeNkd8XHz-3xqQ4gB_wbLaDKghMvUJqFYoy5T",
                "Content-Type: application/json"
            ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            }
        }
        elseif($push_notification->send_to == '2'){
            $user = User::where('firebase_key','!=',null)->where('status',4)->get();
            foreach($user as $user1){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$user1->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAAlESNo9M:APA91bHKOmvgPs5gn_Gtbtgr0k5PogtXfMIgQmF7bA7X9Uy3VsNnVbSX-AOiETPeEplQiDaoDBFACzYxw7y6w77bjvg6CscQ5riG_U9burGBv1b2fO_XI1Mtyyozl57Rvfz0KM4Z16K6",
                "Content-Type: application/json"
            ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            }
        }
        elseif($push_notification->send_to == '3'){
            foreach(explode(',',$push_notification->agent_ids) as $agent_id){
            $agent = agent::find($agent_id);
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$agent->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAA8MuJ8ds:APA91bG2jOF4RQMoEu_sThruub8PeCu6SYjOOBA1Ba1TNd561DK9OPfqnEZS1GlD5BFfDvDsZBwkbCltNbfNU0Z3IO1emZniEYGuGPSmeNkd8XHz-3xqQ4gB_wbLaDKghMvUJqFYoy5T",
                "Content-Type: application/json"
            ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            }
        }
        elseif($push_notification->send_to == '4'){
            foreach(explode(',',$push_notification->customer_ids) as $customer_id){
            $user = User::find($customer_id);
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$user->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAAlESNo9M:APA91bHKOmvgPs5gn_Gtbtgr0k5PogtXfMIgQmF7bA7X9Uy3VsNnVbSX-AOiETPeEplQiDaoDBFACzYxw7y6w77bjvg6CscQ5riG_U9burGBv1b2fO_XI1Mtyyozl57Rvfz0KM4Z16K6",
                "Content-Type: application/json"
            ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            }
        }
        return response()->json(['message'=>'Successfully Send'],200); 
    }

    public function getNotificationAgent($id){ 
        $data  = push_notification::find($id);
        $agent = agent::all();
    
        $arraydata=array();
        foreach(explode(',',$data->agent_ids) as $agent1){
            $arraydata[]=$agent1;
        }
        $output = '';
        foreach ($agent as $value){
            if(in_array($value->id , $arraydata))
            {
                $output .='<option selected="true" value="'.$value->id.'">'.$value->name.'</option>'; 
            }
            else{
                $output .='<option value="'.$value->id.'">'.$value->name.'</option>'; 
            }
        }      
        echo $output;
    }

    public function getNotificationUser($id){ 
        $data  = push_notification::find($id);
        $customer = User::all();
    
        $arraydata=array();
        foreach(explode(',',$data->customer_ids) as $customer1){
            $arraydata[]=$customer1;
        }
        $output = '';
        foreach ($customer as $value){
            if(in_array($value->id , $arraydata))
            {
                $output .='<option selected="true" value="'.$value->id.'">'.$value->first_name.' '.$value->last_name.'</option>'; 
            }
            else{
                $output .='<option value="'.$value->id.'">'.$value->first_name.' '.$value->last_name.'</option>'; 
            }
        }      
        echo $output;
    }






}
