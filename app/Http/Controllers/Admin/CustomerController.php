<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\role;
use App\Models\add_rate;
use App\Models\add_rate_item;
use App\Models\country;
use App\Models\city;
use App\Models\settings;
use App\Models\language;
use Auth;
use Mail;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
    }

    public function viewCustomer(){
        $customer = User::orderBy('id','DESC')->get();
        $role_get = role::find(Auth::guard('admin')->user()->role_id);
        $settings = settings::find(1);
        $language = language::all();

        if(Auth::guard('admin')->user()->role_id == 1){
            return view('admin.admin_customer',compact('customer','role_get','settings', 'language' ));
        }
        else if(Auth::guard('admin')->user()->role_id == 2){
            return view('admin.registration_customer',compact('customer','role_get','settings', 'language'));
        }
        else if(Auth::guard('admin')->user()->role_id == 3){
            return view('admin.sales_customer',compact('customer','role_get','settings','language'));
        }
        else if(Auth::guard('admin')->user()->role_id == 4){
            return view('admin.accounts_customer',compact('customer','role_get','settings','language'));
        }else{
           return view('admin.admin_customer',compact('customer','role_get','settings', 'language' ));
        }
    }

    public function registrationCustomer(){
      $customer = User::orderBy('id','DESC')->get();
      $role_get = role::find(Auth::guard('admin')->user()->role_id);
      $settings = settings::find(1);
      $language = language::all();

      return view('admin.registration_customer',compact('customer','role_get','settings', 'language'));
    }

    public function salesCustomer(){
      $customer = User::orderBy('id','DESC')->get();
      $role_get = role::find(Auth::guard('admin')->user()->role_id);
      $settings = settings::find(1);
      $language = language::all();

      return view('admin.sales_customer',compact('customer','role_get','settings', 'language'));
    }

    public function accountsCustomer(){
      $customer = User::orderBy('id','DESC')->get();
      $role_get = role::find(Auth::guard('admin')->user()->role_id);
      $settings = settings::find(1);
      $language = language::all();

      return view('admin.accounts_customer',compact('customer','role_get','settings', 'language'));
    }

    public function activeCustomer(){
      $customer = User::orderBy('id','DESC')->get();
      $role_get = role::find(Auth::guard('admin')->user()->role_id);
      $settings = settings::find(1);
      $language = language::all();

      return view('admin.active_customer',compact('customer','role_get','settings', 'language'));
    }

    public function editCustomer($id){
        $customer = User::find($id);
        return response()->json($customer); 
    }

    public function getRateCardStaus($id){
        $add_rate = add_rate::where('user_id',$id)->first();

        $data = array(
            'status' => 0,
            'customer_id' => $id,
        );
        if(empty($add_rate)){
            $data['status'] = 1;
        }
        if(!empty($add_rate)){
            $data['status'] = 2;
        }
        return response()->json($data); 
    }

    public function updateVerifyStatus(Request $request){
        $customer = User::find($request->id);
        $customer->verify_remark = $request->deny_remark;
        $customer->status = $request->status;
        $customer->registration_user_id = Auth::guard('admin')->user()->role_id;
        $customer->registration_date_time = date('Y-m-d H:i:s');
        $customer->save();

        return response()->json('successfully save'); 
    }

    public function saveSalesTeamProcess(Request $request){
        $add_rate = new add_rate;
        $add_rate->user_id = $request->customer_id;
        $add_rate->insurance_enable = $request->insurance_enable;
        $add_rate->insurance_percentage = $request->insurance_percentage;
        $add_rate->vat_enable = $request->vat_enable;
        $add_rate->vat_percentage = $request->vat_percentage;
        $add_rate->cod_enable = $request->cod_enable;
        $add_rate->cod_price = $request->cod_price;
        $add_rate->postal_charge_enable = $request->postal_charge_enable;
        $add_rate->postal_charge_percentage = $request->postal_charge_percentage;
        $add_rate->before_5_kg_price = $request->before_5_kg_price;
        $add_rate->above_5_kg_price = $request->above_5_kg_price;
        $add_rate->service_area_20_to_1000_kg_price = $request->service_area_20_to_1000_kg_price;
        $add_rate->same_day_delivery_20_to_1000_kg_price = $request->same_day_delivery_20_to_1000_kg_price;
        $add_rate->save();

        for ($x=0; $x<count($_POST['weight_from']); $x++) 
    	  {
          $add_rate_item = new add_rate_item;
          $add_rate_item->user_id = $request->customer_id;
	        $add_rate_item->weight_from = $_POST['weight_from'][$x];
	        $add_rate_item->weight_to = $_POST['weight_to'][$x];
          $add_rate_item->price = $_POST['price'][$x];
          $add_rate_item->status = 1;

	        if($_POST['weight_from'][$x]!=""){
				    $add_rate_item->save();
	    	  }
        }

        for ($x=0; $x<count($_POST['weight_from1']); $x++) 
    	  {
          $add_rate_item = new add_rate_item;
          $add_rate_item->user_id = $request->customer_id;
	        $add_rate_item->weight_from = $_POST['weight_from1'][$x];
	        $add_rate_item->weight_to = $_POST['weight_to1'][$x];
          $add_rate_item->price = $_POST['price1'][$x];
          $add_rate_item->status = 2;

	        if($_POST['weight_from1'][$x]!=""){
				    $add_rate_item->save();
	        }
        }
                
        // $all = User::find($request->customer_id);
        // $rate = add_rate::where('user_id',$request->customer_id)->first();
        // $rate_item = add_rate_item::where('user_id',$request->customer_id)->get();
        // $customer = User::find($request->customer_id);
        // $settings = settings::find(1);
        
        // Mail::send('mail.sales_table',compact('rate','rate_item','settings','customer'),function($message) use($all){
        //     $message->to($all->email)->subject('Well Well Express - Your Account Price');
        //     $message->from('info@lrbtech.com','Well Well Express');
        // });

        return response()->json('successfully save'); 
    }


    public function updateSalesTeamProcess(Request $request){
      $add_rate = add_rate::where('user_id',$request->customer_id)->first();
      $add_rate->user_id = $request->customer_id;
      $add_rate->insurance_enable = $request->insurance_enable;
      $add_rate->insurance_percentage = $request->insurance_percentage;
      $add_rate->vat_enable = $request->vat_enable;
      $add_rate->vat_percentage = $request->vat_percentage;
      $add_rate->cod_enable = $request->cod_enable;
      $add_rate->cod_price = $request->cod_price;
      $add_rate->postal_charge_enable = $request->postal_charge_enable;
      $add_rate->postal_charge_percentage = $request->postal_charge_percentage;
      $add_rate->before_5_kg_price = $request->before_5_kg_price;
      $add_rate->above_5_kg_price = $request->above_5_kg_price;
      $add_rate->service_area_20_to_1000_kg_price = $request->service_area_20_to_1000_kg_price;
      $add_rate->same_day_delivery_20_to_1000_kg_price = $request->same_day_delivery_20_to_1000_kg_price;
      $add_rate->save();

      $add_rate_item = add_rate_item::where('user_id',$request->customer_id)->delete();

      for ($x=0; $x<count($_POST['weight_from']); $x++) 
      {
        $add_rate_item = new add_rate_item;
        $add_rate_item->user_id = $request->customer_id;
        $add_rate_item->weight_from = $_POST['weight_from'][$x];
        $add_rate_item->weight_to = $_POST['weight_to'][$x];
        $add_rate_item->price = $_POST['price'][$x];
        $add_rate_item->status = 1;

        if($_POST['weight_from'][$x]!=""){
          $add_rate_item->save();
        }
      }

      for ($x=0; $x<count($_POST['weight_from1']); $x++) 
      {
        $add_rate_item = new add_rate_item;
        $add_rate_item->user_id = $request->customer_id;
        $add_rate_item->weight_from = $_POST['weight_from1'][$x];
        $add_rate_item->weight_to = $_POST['weight_to1'][$x];
        $add_rate_item->price = $_POST['price1'][$x];
        $add_rate_item->status = 2;

        if($_POST['weight_from1'][$x]!=""){
          $add_rate_item->save();
        }
      }

        // $all = User::find($request->customer_id);
        // $rate = add_rate::where('user_id',$request->customer_id)->first();
        // $rate_item = add_rate_item::where('user_id',$request->customer_id)->get();
        // $customer = User::find($request->customer_id);
        // $settings = settings::find(1);
        
        // Mail::send('mail.sales_table',compact('rate','rate_item','settings','customer'),function($message) use($all){
        //     $message->to($all->email)->subject('Well Well Express - Your Account Price');
        //     $message->from('info@lrbtech.com','Well Well Express');
        // });
              
      return response()->json('successfully save'); 
  }

  public function sendMailSalesTeam($id){
    $all = User::find($id);
    $rate = add_rate::where('user_id',$id)->first();
    $rate_item = add_rate_item::where('user_id',$id)->get();
    $customer = User::find($id);
    $settings = settings::find(1);
    
    Mail::send('mail.sales_table',compact('rate','rate_item','settings','customer'),function($message) use($all){
        $message->to($all->email)->subject('Well Well Express - Your Account Price');
        $message->from('info@lrbtech.com','Well Well Express');
    });
              
    return response()->json('successfully send'); 
  }

    public function updateAccountStatus($id,$status){
        $customer = User::find($id);
        $customer->status = $status;
        $customer->accounts_user_id = Auth::guard('admin')->user()->role_id;
        $customer->accounts_date_time = date('Y-m-d H:i:s');
        $customer->save();

        $all = User::find($id);
        Mail::send('mail.verify_complete',compact('all'),function($message) use($all){
            $message->to($all->email)->subject('Well Well Express - verification completed');
            $message->from('info@lrbinfotech.com','Well Well Express');
        });

        return response()->json('successfully save'); 
    }


    public function updateSalestStatus($id,$status){
        $customer = User::find($id);
        $customer->status = $status;
        $customer->sales_user_id = Auth::guard('admin')->user()->role_id;
        $customer->sales_date_time = date('Y-m-d H:i:s');
        $customer->save();

        return response()->json('successfully save'); 
    }

    public function viewProfile($id){
        $country = country::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $rate = add_rate::where('user_id',$id)->first();
        $rate_item = add_rate_item::where('user_id',$id)->get();

        $language = language::all();

        $customer = User::find($id);
        $settings = settings::find(1);
        
        return view('admin.profile',compact('rate','rate_item','customer','country','city','area','settings','language'));
    }



public function editRateCard($id)
{
$data = add_rate::where('user_id',$id)->first();
$settings = settings::find(1);
$output='<div class="row service_area">
<div class="form-group col-md-3">
  <div class="checkbox checkbox-primary">';
  if($data->insurance_enable == '1'){
    $output.='<input checked value="1" id="insurance_enable" name="insurance_enable" type="checkbox">';
  }
  else{
    $output.='<input value="1" id="insurance_enable" name="insurance_enable" type="checkbox">';
  }
    $output.='<label for="insurance_enable">Insurance (%)</label>
  </div>
  <input value="'.$settings->insurance_percentage.'" readonly autocomplete="off" type="text" id="insurance_percentage" name="insurance_percentage" class="form-control">
</div>
<div class="form-group col-md-3">
  <div class="checkbox checkbox-primary">';
  if($data->vat_enable == '1'){
    $output.='<input checked value="1" id="vat_enable" name="vat_enable" type="checkbox">';
  }
  else{
    $output.='<input value="1" id="vat_enable" name="vat_enable" type="checkbox">';
  }
  $output.='<label for="vat_enable">Vat (%)</label>
  </div>
  <input value="'.$settings->vat_percentage.'" readonly autocomplete="off" type="text" id="vat_percentage" name="vat_percentage" class="form-control">
</div>
<div class="form-group col-md-3">
  <div class="checkbox checkbox-primary">';
  if($data->postal_charge_enable == '1'){
    $output.='<input checked value="1" id="postal_charge_enable" name="postal_charge_enable" type="checkbox">';
  }
  else{
    $output.='<input value="1" id="postal_charge_enable" name="postal_charge_enable" type="checkbox">';
  }
  $output.='<label for="postal_charge_enable">Postal Charge (%)</label>
  </div>
  <input value="'.$settings->postal_charge_percentage.'" readonly autocomplete="off" type="text" id="postal_charge_percentage" name="postal_charge_percentage" class="form-control">
</div>
<div class="form-group col-md-3">
  <div class="checkbox checkbox-primary">';
  if($data->cod_enable == '1'){
    $output.='<input checked value="1" id="cod_enable" name="cod_enable" type="checkbox">';
  }
  else{
    $output.='<input value="1" id="cod_enable" name="cod_enable" type="checkbox">';
  }
  $output.='<label for="cod_enable">Cash on Delivery</label>
  </div>
  <input value="'.$data->cod_price.'" autocomplete="off" type="text" id="cod_price" name="cod_price" class="form-control">
</div>
</div>

<div class="row non_service_area hide">
<div class="form-group col-md-6">
  <label>0 to 5 kg Price</label>
  <input value="'.$data->before_5_kg_price.'" autocomplete="off" type="text" id="before_5_kg_price" name="before_5_kg_price" class="form-control">
</div>
<div class="form-group col-md-6">
  <label>Above 5 kg Price (Per kg)</label>
  <input value="'.$data->above_5_kg_price.'" autocomplete="off" type="text" id="above_5_kg_price" name="above_5_kg_price" class="form-control">
</div>
</div>

<div class="row services_area_table">
<table id="productTable" class="table">
<thead class="thead-primary">
    <tr style="text-align: center;">
      <th colspan="2">
          <label>20 to 1000 kg Price (Per kg)</label>
      </th>
      <th colspan="2">
          <input value="'.$data->service_area_20_to_1000_kg_price.'" autocomplete="off" type="text" id="service_area_20_to_1000_kg_price" name="service_area_20_to_1000_kg_price" class="form-control">
      </th>
    </tr>
    <tr style="text-align: center;">
        <th>Weight from</th>
        <th>Weight to</th>
        <th>Service Area Price</th>
        <th style="width: 3%;padding: .0rem !important;">
            <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </th>
    </tr>
</thead>
<tbody id="productTabletbody">';
$add_rate_item = add_rate_item::where('user_id',$id)->where('status',1)->get();
$x=0;
foreach ($add_rate_item as $value) {
  $x++;
  $output.='<tr value="'.$x.'" id="rows'.$x.'">
      <td><input value="'.$value->weight_from.'" style="text-align:right;" type="text" name="weight_from[]" id="weight_from'.$x.'" autocomplete="off" class="form-control" /></td>
      <td><input value="'.$value->weight_to.'" style="text-align:right;" type="text" name="weight_to[]" id="weight_to'.$x.'" autocomplete="off" class="form-control" /></td>
      <td><input value="'.$value->price.'" style="text-align:right;" type="text" name="price[]" id="price'.$x.'" autocomplete="off" class="form-control" /></td>
      <td align="center"><button id="removeProductRowBtnn'.$x.'" class="btn btn-default removeProductRowBtnn" type="button" onclick="removeProductRows('.$x.')"><i class="fa fa-minus" aria-hidden="true"></i></button></td>
  </tr>';
 }
 $output.='</tbody>
</table>
</div>

<div class="row same_day_delivery_table hide">
<table id="productTable1" class="table">
<thead class="thead-primary">
    <tr style="text-align: center;">
      <th colspan="2">
          <label>20 to 1000 kg Price (Per kg)</label>
      </th>
      <th colspan="2">
          <input value="'.$data->same_day_delivery_20_to_1000_kg_price.'" autocomplete="off" type="text" id="same_day_delivery_20_to_1000_kg_price" name="same_day_delivery_20_to_1000_kg_price" class="form-control">
      </th>
    </tr>
    <tr style="text-align: center;">
        <th>Weight from</th>
        <th>Weight to</th>
        <th>Same Day Delivery Price</th>
        <th style="width: 3%;padding: .0rem !important;">
            <button type="button" class="btn btn-default" onclick="addRow1()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus" aria-hidden="true"></i></button>
        </th>
    </tr>
</thead>
<tbody id="productTabletbody1">';
$add_rate_item = add_rate_item::where('user_id',$id)->where('status',2)->get();
$y=0;
foreach ($add_rate_item as $value) {     
  $y++;      
  $output.='<tr value="'.$y.'" id="rows'.$y.'">
      <td><input value="'.$value->weight_from.'" style="text-align:right;" type="text" name="weight_from1[]" id="weight_from1'.$y.'" autocomplete="off" class="form-control" /></td>
      <td><input value="'.$value->weight_to.'" style="text-align:right;" type="text" name="weight_to1[]" id="weight_to1'.$y.'" autocomplete="off" class="form-control" /></td>
      <td><input value="'.$value->price.'" style="text-align:right;" type="text" name="price1[]" id="price1'.$y.'" autocomplete="off" class="form-control" /></td>
      <td align="center"><button id="removeProductRowBtnn'.$y.'" class="btn btn-default removeProductRowBtnn" type="button" onclick="removeProductRows('.$y.')"><i class="fa fa-minus" aria-hidden="true"></i></button></td>
  </tr>';
}
$output.='</tbody>
</table>
</div>';

echo $output;
//return response()->json($data); 
}



}
