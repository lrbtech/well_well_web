<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\push_notification;
use App\Models\agent;
use Hash;
use Auth;

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
        if($request->send_to == '2'){
            $agent1;
            foreach($request->agent_id as $row){
                $agent1[]=$row;
            }
            $agent_id = collect($agent1)->implode(',');
        }

        $push_notification = new push_notification;
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->expiry_date = $request->expiry_date;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '2'){
        $push_notification->agent_ids = $agent_id;
        }
        $push_notification->save();

        return response()->json('successfully save'); 
    }

    public function saveSendNotification(Request $request){
        $request->validate([
            'title'=>'required',
        ]);

        $agent_id='';
        if($request->send_to == '2'){
            $agent1;
            foreach($request->agent_id as $row){
                $agent1[]=$row;
            }
            $agent_id = collect($agent1)->implode(',');
        }
        $push_notification = new push_notification;
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->expiry_date = $request->expiry_date;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '2'){
        $push_notification->agent_ids = $agent_id;
        }
        $push_notification->save();

        $this->sendNotification($push_notification->id);
        return response()->json('successfully save'); 
    }

    public function updateNotification(Request $request){
        $request->validate([
            'title'=> 'required',
        ]);
        
        $agent_id='';
        if($request->send_to == '2'){
            $agent1;
            foreach($request->agent_id as $row){
                $agent1[]=$row;
            }
            $agent_id = collect($agent1)->implode(',');
        }
        $push_notification = push_notification::find($request->id);
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->expiry_date = $request->expiry_date;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '2'){
        $push_notification->agent_ids = $agent_id;
        }
        $push_notification->save();

        return response()->json('successfully update'); 
    }

    public function updateSendNotification(Request $request){
        $request->validate([
            'title'=> 'required',
        ]);
        
        $agent_id='';
        if($request->send_to == '2'){
            $agent1;
            foreach($request->agent_id as $row){
                $agent1[]=$row;
            }
            $agent_id = collect($agent1)->implode(',');
        }
        $push_notification = push_notification::find($request->id);
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->expiry_date = $request->expiry_date;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '2'){
        $push_notification->agent_ids = $agent_id;
        }
        $push_notification->save();

        $this->sendNotification($push_notification->id);

        return response()->json('successfully update'); 
    }

    public function Notification(){
        $push_notification = push_notification::all();
        $agent = agent::all();
        return view('admin.push_notification',compact('push_notification','agent'));
    }

    public function editNotification($id){
        $push_notification = push_notification::find($id);
        return response()->json($push_notification); 
    }
    
    public function deleteNotification($id){
        $push_notification = push_notification::find($id);
        $push_notification->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function sendNotification($id){
        //$body = "Pickup date/time : ".$request->pickup_date.'/'.$request->pickup_time.' Delivery Type :'.$request->delivery_option;
        $push_notification = push_notification::find($id);

        if($push_notification->send_to == '1'){
            $agent = agent::where('firebase_key','!=',null)->get();
            foreach($salon as $salon1){
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
                "Authorization: key=AAAAoZ2bbM0:APA91bF6daZlElRDd4EhxqKm3ThtWlEDugroa1a83scavpILHohGCZWUfN5DX7zsfRnZBHUWJF1rorEdvm4vAi6xxAuC9pSFfEnqZdy4_qkdQSVG23v6K7LADuBzQnrldACFpI9PnFoN",
                "Content-Type: application/json"
            ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            }
        }
        elseif($push_notification->send_to == '2'){
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
                "Authorization: key=AAAAoZ2bbM0:APA91bF6daZlElRDd4EhxqKm3ThtWlEDugroa1a83scavpILHohGCZWUfN5DX7zsfRnZBHUWJF1rorEdvm4vAi6xxAuC9pSFfEnqZdy4_qkdQSVG23v6K7LADuBzQnrldACFpI9PnFoN",
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






}
