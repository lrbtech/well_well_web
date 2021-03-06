<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
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
use App\Models\language;
use App\Models\exception_category;
use App\Models\system_logs;
use App\Models\shipment_package;
use App\Models\shipment;
use App\Models\weeks;
use App\Models\role;
use Hash;
use Auth;
use DB;
use App\Http\Controllers\Admin\logController;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Weeks(){
        $weeks = weeks::all();
        $language = language::all();
        return view('admin.weeks',compact('weeks','language'));
    }


    public function updateWeeks(Request $request){

        for ($x=0; $x<count($_POST['timing_id']); $x++) 
        {
            $weeks = weeks::find($_POST['timing_id'][$x]);
            $weeks->open_time = $_POST['open_time'][$x];
            $weeks->close_time = $_POST['close_time'][$x];
            $weeks->status = $_POST['status'][$x];
            $weeks->save();
        }

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Schedule time");

        return response()->json('Successfully Update'); 
    }

    public function Settings(){
        $settings = settings::find(1);
        $language = language::all();
        return view('admin.settings',compact('settings','language'));
    }

    public function updateSettings(Request $request){
        $this->validate($request, [
            'insurance_percentage'=>'required',
            'vat_percentage'=> 'required',
            'postal_charge_percentage'=> 'required',
            //'cod_amount'=> 'required',
          ],[
            'vat_percentage.required' => 'Vat Percentage Field is Required',
        ]);
        $settings = settings::find($request->id);
        $settings->insurance_percentage = $request->insurance_percentage;
        $settings->vat_percentage = $request->vat_percentage;
        $settings->postal_charge_percentage = $request->postal_charge_percentage;
        //$settings->cod_amount = $request->cod_amount;
        $settings->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Financial Settings");

        return response()->json('successfully update'); 
    }

    public function SocialMediaLink(){
        $settings = settings::find(1);
        $language = language::all();
        return view('admin.social_media_link',compact('settings','language'));
    }

    public function updateSocialMediaLink(Request $request){
        $settings = settings::find($request->id);
        $settings->facebook_url = $request->facebook_url;
        $settings->twitter_url = $request->twitter_url;
        $settings->linkedin_url = $request->linkedin_url;
        $settings->instagram_url = $request->instagram_url;
        $settings->youtube_url = $request->youtube_url;
        $settings->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Social Media Settings");

        return response()->json('successfully update'); 
    }

    public function TermsAndConditions(){
        $settings = settings::find(1);
        $language = language::all();
        return view('admin.terms_and_conditions',compact('settings','language'));
    }

    public function updateTermsAndConditions(Request $request){
        $settings = settings::find($request->id);
        $settings->mobile_terms_english = $request->mobile_terms_english;
        $settings->terms_and_conditions = $request->editor1;
        $settings->save();
        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Terms and Conditions");
        return back();
        //return response()->json('successfully update'); 
    }

    public function getCommonPrice(){
        $common_price = common_price::all();
        $language = language::all();
        return view('admin.common_price',compact('common_price','language'));
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

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Common Price");

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

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Drop Point '.$drop_point->drop_point_name.'");

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

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Drop Point '.$drop_point->drop_point_name.'");

        return response()->json('successfully update'); 
    }

    public function DropPoint(){
        $drop_point = drop_point::all();
        $country = country::all();
        $city = city::where('parent_id',0)->get();
        $area = city::where('parent_id','!=',0)->get();
        $language = language::all();
        return view('admin.drop_point',compact('drop_point','country','city','area','language'));
    }

    public function editDropPoint($id){
        $drop_point = drop_point::find($id);
        return response()->json($drop_point); 
    }
    
    public function deleteDropPoint($id){
        $drop_point = drop_point::find($id);
        $drop_point->delete();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Drop Point '.$drop_point->drop_point_name.'");

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

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Package Category '.$package_category->category.'");

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

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Package Category '.$package_category->category.'");

        return response()->json('successfully update'); 
    }

    public function packageCategory(){
        $package_category = package_category::all();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.package_category',compact('package_category','language','role_get'));
    }

    public function editpackageCategory($id){
        $package_category = package_category::find($id);
        return response()->json($package_category); 
    }
    
    public function deletepackageCategory($id,$status){
        $package_category = package_category::find($id);
        $package_category->status = $status;
        $package_category->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Package Category '.$package_category->category.'");

        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function saveExceptionCategory(Request $request){
        $this->validate($request, [
            'category'=>'required',
            'exception_status'=>'required',
          ],[
            'category.required' => 'Exception Category Field is Required',
        ]);

        $exception_category = new exception_category;
        $exception_category->category = $request->category;
        $exception_category->exception_status = $request->exception_status;
        $exception_category->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Exception Category '.$exception_category->category.'");

        return response()->json('successfully save'); 
    }
    public function updateExceptionCategory(Request $request){
        $this->validate($request, [
            'category'=>'required',
            'exception_status'=>'required',
          ],[
            'category.required' => 'Exception Category Field is Required',
        ]);

        $exception_category = exception_category::find($request->id);
        $exception_category->category = $request->category;
        $exception_category->exception_status = $request->exception_status;
        $exception_category->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Exception Category '.$exception_category->category.'");

        return response()->json('successfully update'); 
    }

    public function ExceptionCategory(){
        $exception_category = exception_category::all();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.exception_category',compact('exception_category','language','role_get'));
    }

    public function editExceptionCategory($id){
        $exception_category = exception_category::find($id);
        return response()->json($exception_category); 
    }
    
    public function deleteExceptionCategory($id,$status){
        $exception_category = exception_category::find($id);
        $exception_category->status = $status;
        $exception_category->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Exception Category '.$exception_category->category.'");

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

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Create Station '.$station->station.'");

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

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Edit Station '.$station->station.'");

        return response()->json('successfully update'); 
    }

    public function Station(){
        $station = station::all();
        $language = language::all();
        $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();
        return view('admin.station',compact('station','language','role_get'));
    }

    public function editStation($id){
        $station = station::find($id);
        return response()->json($station); 
    }
    
    public function deleteStation($id,$status){
        $station = station::find($id);
        $station->status = $status;
        $station->save();

        $logController = new logController();
        $logController->createLog(Auth::guard('admin')->user()->email," Delete Station '.$station->station.'");

        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function changePassword()
    {
        $language = language::all();
        $user = admin::find(Auth::guard('admin')->user()->id);
        return view('admin.change_password',compact('user','language'));
    }

    public function ChangeProfileImage()
    {
        $language = language::all();
        $user = admin::find(Auth::guard('admin')->user()->id);
        return view('admin.change_profile_image',compact('user','language'));
    }

    public function updateChangeProfileImage(Request $request){        
        $user = admin::find(Auth::guard('admin')->user()->id);
        if($request->file('profile_image')!=""){
            $old_image = "upload_files/".$user->profile_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('profile_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $user->profile_image = $fileName;
        }
        $user->save();
        return response()->json('successfully save'); 
    }

    public function changelanguage($language)
    {
        $user = admin::find(Auth::guard('admin')->user()->id);
        $user->lang = $language;
        $user->save();
        return response()->json(['message'=>'Successfully Update'],200); 
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

                $logController = new logController();
                $logController->createLog(Auth::guard('admin')->user()->email," Password Changed");

            }
 
            else{
                return response()->json(['message' => 'new password can not be the old password!' , 'status' => 0]);
            }
 
           }
 
        else{
            return response()->json(['message' => 'old password doesnt matched!' , 'status' => 0]);
        }
    }

    public function languageTable(){
        $language = language::all();
        return view('admin.languages',compact('language'));
    }
    
    public function fetchLanguage(Request $request){
       $language = array();
      // return response()->json();
        if($request['english'] !=null){
            $language = language::where('english', 'like', '%' . $request['english'].'%')->get();
        }else if($request['arabic'] !=null){
            $language = language::where('arabic', 'like', '%' . $request['arabic']. '%')->get();
        }else{
            $language = language::all();
        }
       
         $languages = array();
        if(count($language) >0){
            foreach ($language as $key => $value) {
               $lang=array(
                   'arabic'=>$value->arabic,
                   'english'=>$value->english,
                   'id'=>$value->id,
                   'index'=>$key,
               ); 
              // $language[] = $lang;
               $languages[]=$lang;
            }
            return response()->json($languages);
        }
        return response()->json($language);
    }

    public function insertLanguage(Request $request){
        $language = new language;
        $language->english = $request->english;
        $language->arabic = $request->arabic;
        $language->save();
    }
    public function updateLanguage(Request $request){
        $language =  language::find($request->id);
        $language->english = $request->english;
        $language->arabic = $request->arabic;
        $language->save();
    }
    // public function deleteLanguage(Request $request){
    //     $language =  language::find($request->id)->delete();
    // }

    
    //            $languages[]=$lang;
    //         }
    //         return response()->json($languages);
    //     }
    //     return response()->json($language);
    // }

    // public function insertLanguage(Request $request){
    //     $language = new language;
    //     $language->english = $request->english;
    //     $language->arabic = $request->arabic;
    //     $language->save();
    // }
    // public function updateLanguage(Request $request){
    //     $language =  language::find($request->id);
    //     $language->english = $request->english;
    //     $language->arabic = $request->arabic;
    //     $language->save();
    // }
    // public function deleteLanguage(Request $request){
    //     $language =  language::find($request->id)->delete();
    // }

    public function systemLogs(){
        $language = language::all();
        return view('admin.system_logs',compact('language'));
    }


}
