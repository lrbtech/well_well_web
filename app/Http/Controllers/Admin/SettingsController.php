<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\drop_point;
use App\Models\country;
use App\Models\city;
use App\Models\package_category;
use App\Models\shipment_category;
use App\Models\manage_address;
use App\Models\settings;
use App\Models\station;
use App\Models\admin;
use App\Models\common_price;
use App\Models\exception_category;
use Hash;
use Auth;


class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Settings(){
        $settings = settings::find(1);
        return view('admin.settings',compact('settings'));
    }

    public function updateSettings(Request $request){
        $this->validate($request, [
            'insurance_percentage'=>'required',
            'vat_percentage'=> 'required',
            'postal_charge_percentage'=> 'required',
          ],[
            'vat_percentage.required' => 'Vat Percentage Field is Required',
        ]);
        $settings = settings::find($request->id);
        $settings->insurance_percentage = $request->insurance_percentage;
        $settings->vat_percentage = $request->vat_percentage;
        $settings->postal_charge_percentage = $request->postal_charge_percentage;
        $settings->save();

        return response()->json('successfully update'); 
    }

    public function getCommonPrice(){
        $common_price = common_price::all();
        return view('admin.common_price',compact('common_price'));
    }

    public function saveCommonPrice(Request $request){
        $common_price_delete = common_price::truncate();

        for ($x=0; $x<count($_POST['weight_from']); $x++) 
    	  {
            $common_price = new common_price;
	        $common_price->weight_from = $_POST['weight_from'][$x];
	        $common_price->weight_to = $_POST['weight_to'][$x];
            $common_price->price = $_POST['price'][$x];

	        if($_POST['weight_from'][$x]!=""){
			    $common_price->save();
	    	}
        }
        return response()->json('successfully save'); 
    }

    public function saveDropPoint(Request $request){
        $this->validate($request, [
            'drop_point_name'=>'required',
            'address1'=> 'required',
          ],[
            'address1.required' => 'Atlease Address One Field is Required',
        ]);

        $drop_point = new drop_point;
        $drop_point->drop_point_name = $request->drop_point_name;
        $drop_point->address1 = $request->address1;
        $drop_point->address2 = $request->address2;
        $drop_point->area_id = $request->area_id;
        $drop_point->city_id = $request->city_id;
        $drop_point->country_id = $request->country_id;
        $drop_point->latitude = $request->latitude;
        $drop_point->longitude = $request->longitude;
        $drop_point->save();

        return response()->json('successfully save'); 
    }
    public function updateDropPoint(Request $request){
        $this->validate($request, [
            'drop_point_name'=>'required',
            'address1'=> 'required',
          ],[
            'address1.required' => 'Atlease Address One Field is Required',
        ]);
        $drop_point = drop_point::find($request->id);
        $drop_point->drop_point_name = $request->drop_point_name;
        $drop_point->address1 = $request->address1;
        $drop_point->address2 = $request->address2;
        $drop_point->area_id = $request->area_id;
        $drop_point->city_id = $request->city_id;
        $drop_point->country_id = $request->country_id;
        $drop_point->latitude = $request->latitude;
        $drop_point->longitude = $request->longitude;
        $drop_point->save();

        return response()->json('successfully update'); 
    }

    public function DropPoint(){
        $drop_point = drop_point::all();
        $country = country::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        return view('admin.drop_point',compact('drop_point','country','city','area'));
    }

    public function editDropPoint($id){
        $drop_point = drop_point::find($id);
        return response()->json($drop_point); 
    }
    
    public function deleteDropPoint($id){
        $drop_point = drop_point::find($id);
        $drop_point->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function savepackageCategory(Request $request){
        $this->validate($request, [
            'category'=>'required',
          ],[
            'category.required' => 'Package Category Field is Required',
        ]);

        $package_category = new package_category;
        $package_category->category = $request->category;
        $package_category->save();

        return response()->json('successfully save'); 
    }
    public function updatepackageCategory(Request $request){
        $this->validate($request, [
            'category'=>'required',
          ],[
            'category.required' => 'Package Category Field is Required',
        ]);

        $package_category = package_category::find($request->id);
        $package_category->category = $request->category;
        $package_category->save();

        return response()->json('successfully update'); 
    }

    public function packageCategory(){
        $package_category = package_category::all();
        return view('admin.package_category',compact('package_category'));
    }

    public function editpackageCategory($id){
        $package_category = package_category::find($id);
        return response()->json($package_category); 
    }
    
    public function deletepackageCategory($id){
        $package_category = package_category::find($id);
        $package_category->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function saveExceptionCategory(Request $request){
        $this->validate($request, [
            'category'=>'required',
          ],[
            'category.required' => 'Exception Category Field is Required',
        ]);

        $exception_category = new exception_category;
        $exception_category->category = $request->category;
        $exception_category->save();

        return response()->json('successfully save'); 
    }
    public function updateExceptionCategory(Request $request){
        $this->validate($request, [
            'category'=>'required',
          ],[
            'category.required' => 'Exception Category Field is Required',
        ]);

        $exception_category = exception_category::find($request->id);
        $exception_category->category = $request->category;
        $exception_category->save();

        return response()->json('successfully update'); 
    }

    public function ExceptionCategory(){
        $exception_category = exception_category::all();
        return view('admin.exception_category',compact('exception_category'));
    }

    public function editExceptionCategory($id){
        $exception_category = exception_category::find($id);
        return response()->json($exception_category); 
    }
    
    public function deleteExceptionCategory($id){
        $exception_category = exception_category::find($id);
        $exception_category->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function saveStation(Request $request){
        $this->validate($request, [
            'station'=>'required',
          ],[
            'station.required' => 'Station Name Field is Required',
        ]);

        $station = new station;
        $station->station = $request->station;
        $station->save();

        return response()->json('successfully save'); 
    }
    public function updateStation(Request $request){
        $this->validate($request, [
            'station'=>'required',
          ],[
            'station.required' => 'Station Name Field is Required',
        ]);

        $station = station::find($request->id);
        $station->station = $request->station;
        $station->save();

        return response()->json('successfully update'); 
    }

    public function Station(){
        $station = station::all();
        return view('admin.station',compact('station'));
    }

    public function editStation($id){
        $station = station::find($id);
        return response()->json($station); 
    }
    
    public function deleteStation($id){
        $station = station::find($id);
        $station->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function changePassword()
    {
        $user = admin::find(Auth::guard('admin')->user()->id);
        return view('admin.change_password',compact('user'));
    }

    public function updateChangePassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        
        $hashedPassword = Auth::guard('admin')->user()->password;
 
        if (\Hash::check($request->oldpassword , $hashedPassword )) {
 
            if (!\Hash::check($request->password , $hashedPassword)) {
 
                $admin = admin::find($request->id);
                $admin->password = Hash::make($request->password);
                $admin->save();
 
                return response()->json(['message' => 'Password Updated Successfully!' , 'status' => 1], 200);
            }
 
            else{
                return response()->json(['message' => 'new password can not be the old password!' , 'status' => 0]);
            }
 
           }
 
        else{
            return response()->json(['message' => 'old password doesnt matched!' , 'status' => 0]);
        }
    }


}
