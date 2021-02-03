<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\drop_point;
use App\Models\country;
use App\Models\city;
use App\Models\shipment_category;
use App\Models\manage_address;
use App\Models\shipment;
use App\Models\shipment_package;
use App\Models\shipment_notification;
use App\Models\User;
use App\Models\add_rate;
use App\Models\add_rate_item;
use DB;
use Auth;
class AutoCompleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function userSearch(Request $request){
        $search_term = $request->term;

        $availableResults = DB::table('users')
            //->select('id,name,register_number,mobile')
            ->where('first_name', 'like', '%' . $search_term . '%')
            ->where('last_name', 'like', '%' . $search_term . '%')
            ->orWhere('email', 'like', '%' . $search_term . '%')
            ->orWhere('mobile', 'like', '%' . $search_term . '%')
            ->get();
    
        if(!empty($availableResults)){     
            $data['response'] = 'true'; //If username exists set true
            $data['message'] = array();       
            foreach ($availableResults as $key => $value) {                
                $data['message'][] = array(  
                    'label' => $value->first_name.'-'.$value->mobile,
                    'value' => $value->first_name.'-'.$value->mobile,
                    'id'=>$value->id,
                    'first_name'=>$value->first_name,
                    'last_name'=>$value->last_name,
                    'email'=>$value->email,
                    'mobile'=>$value->mobile,
                );
            }        
        }else{
            $data['response'] = 'false';
        }

        echo json_encode($data); 
        exit;
    }

    public function getUserId($id)
    {
    $data = add_rate::where('user_id',$id)->first();
    return response()->json($data); 
    }

    public function getFromAddress(Request $request){
        $search_term = $request->term;

        $availableResults = DB::table('manage_addresses')
            //->select('id,name,register_number,mobile')

            ->where([['contact_name','LIKE','%'.$search_term.'%'],
                    ['from_to','1'],
                    ['user_id',$request->user_id]])
            ->orWhere([['contact_mobile','LIKE','%'.$search_term.'%'],
                    ['from_to','1'],
                    ['user_id',$request->user_id]])
            ->orWhere([['contact_landline','LIKE','%'.$search_term.'%'],
                    ['from_to','1'],
                    ['user_id',$request->user_id]])
            ->get();

    
        if(!empty($availableResults)){     
            $data['response'] = 'true'; //If username exists set true
            $data['message'] = array();       
            foreach ($availableResults as $key => $value) {                
                $data['message'][] = array(  
                    'label' => $value->contact_name.'-'.$value->address1,
                    'value' => $value->contact_name.'-'.$value->address1,
                    'id'=>$value->id
                );
            }        
        }else{
            $data['response'] = 'false';
        }

        echo json_encode($data); 
        exit;
    }

    public function getFromAddressID($id)
    {
    $data = manage_address::find($id);
    $city = city::find($data->city_id);
    $output = '<div class="card">
    <br>
    <div class="media p-20">
        <div class="radio radio-primary mr-3">
        <input checked id="from_address" type="radio" name="from_address" value="'.$data->id.'">
            <label for="from_address"></label>
            </div>
            <div class="media-body">
            <h6 class="mt-0 mega-title-badge">';
                if($data->address_type == 1){
                    $output.= 'Home';
                }
                elseif($data->address_type == 2){
                    $output.= 'Office';
                }
                elseif($data->address_type == 3){
                    $output.= 'Other';
                }
                $output.='<span class="badge badge-primary pull-right digits">
                '.$city->city.'
                </span>
            </h6>
            <p>'.$data->address1.' '.$data->address2.' '.$data->address3.'</p>
            </div>
        </div>
    </div>';

    echo $output;
    //return response()->json($data); 
    }

    public function getToAddress(Request $request){
        $search_term = $request->term;

        $availableResults = DB::table('manage_addresses')
            //->select('id,name,register_number,mobile')
            ->where([['contact_name','LIKE','%'.$search_term.'%'],
                    ['from_to','2'],
                    ['user_id',$request->user_id]])
            ->orWhere([['contact_mobile','LIKE','%'.$search_term.'%'],
                    ['from_to','2'],
                    ['user_id',$request->user_id]])
            ->orWhere([['contact_landline','LIKE','%'.$search_term.'%'],
                    ['from_to','2'],
                    ['user_id',$request->user_id]])
            ->get();
    
        if(!empty($availableResults)){     
            $data['response'] = 'true'; //If username exists set true
            $data['message'] = array();       
            foreach ($availableResults as $key => $value) {                
                $data['message'][] = array(  
                    'label' => $value->contact_name.'-'.$value->address1,
                    'value' => $value->contact_name.'-'.$value->address1,
                    'id'=>$value->id
                );
            }        
        }else{
            $data['response'] = 'false';
        }

        echo json_encode($data); 
        exit;
    }

    public function getToddressID($id)
    {
        $data = manage_address::find($id);
        $city = city::find($data->city_id);
        $output = '<div class="card">
        <br>
        <div class="media p-20">
            <div class="radio radio-primary mr-3">
            <input checked id="to_address" type="radio" name="to_address" value="'.$data->id.'">
                <label for="to_address"></label>
                </div>
                <div class="media-body">
                <h6 class="mt-0 mega-title-badge">';
                    if($data->address_type == 1){
                        $output.= 'Home';
                    }
                    elseif($data->address_type == 2){
                        $output.= 'Office';
                    }
                    elseif($data->address_type == 3){
                        $output.= 'Other';
                    }
                    $output.='<span class="badge badge-primary pull-right digits">
                    '.$city->city.'
                    </span>
                </h6>
                <p>'.$data->address1.' '.$data->address2.' '.$data->address3.'</p>
                </div>
            </div>
        </div>';
    
        echo $output;
        //return response()->json($data); 
    }


}
