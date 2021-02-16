<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\country;
use App\Models\city;
use App\Models\language;
use App\Models\station;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function saveCity(Request $request){
        $request->validate([
            'city'=>'required',
        ]); 

        $city = new city;
        $city->city = $request->city;
        $city->country_id = $request->country_id;
        $city->station_id = $request->station_id;
        $city->lat = $request->lat;
        $city->lng = $request->lng;
        $city->parent_id = 0;
        $city->save();
        return response()->json('successfully save'); 
    }
    public function updateCity(Request $request){
        $request->validate([
            'city'=> 'required',
        ]);
        
        $city = city::find($request->id);
        $city->city = $request->city;
        $city->country_id = $request->country_id;
        $city->station_id = $request->station_id;
        $city->lat = $request->lat;
        $city->lng = $request->lng;
        $city->parent_id = 0;
        $city->save();
        return response()->json('successfully update'); 
    }

    public function City($id){
        $city = city::where('country_id',$id)->where('parent_id',0)->get();
        $country_id = $id;
        $station = station::all();
        $language = language::all();
        return view('admin.city',compact('city','country_id','station','language'));
    }

    public function editCity($id){
        $city = city::find($id);
        return response()->json($city); 
    }
    
    public function deleteCity($id,$status){
        $city = city::find($id);
        $city->status = $status;
        $city->save();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function saveArea(Request $request){
        $request->validate([
            'area'=>'required',
            'remote_area'=>'required',
        ]); 

        $city = new city;
        $city->city = $request->area;
        $city->country_id = $request->country_id;
        $city->remote_area = $request->remote_area;
        $city->parent_id = $request->parent_id;
        $city->save();
        return response()->json('successfully save'); 
    }

    public function updateArea(Request $request){
        $request->validate([
            'area'=> 'required',
            'remote_area'=>'required',
        ]);
        
        $city = city::find($request->id);
        $city->city = $request->area;
        $city->country_id = $request->country_id;
        $city->remote_area = $request->remote_area;
        $city->parent_id = $request->parent_id;
        $city->save();
        return response()->json('successfully update'); 
    }

    public function Area($id,$country_id){
        $area = city::where('country_id',$country_id)->where('parent_id',$id)->get();
        $country_id = $country_id;
        $parent_id = $id;
        $language = language::all();
        return view('admin.area',compact('area','country_id','parent_id','language'));
    }

    public function editArea($id){
        $city = city::find($id);
        return response()->json($city); 
    }
    
    public function deleteArea($id,$status){
        $city = city::find($id);
        $city->status = $status;
        $city->save();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }



    public function saveCountry(Request $request){
        $this->validate($request, [
            'country_code'=>'required',
            'country_name_english'=>'required',
            //'country_name_arabic'=>'required',
            //'phone_count'=>'required',
            'image' => 'mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            //'image.required' => 'Item Image Field is Required',
        ]);
        
        $country = new country;
        $country->country_code = $request->country_code;
        $country->country_name_english = $request->country_name_english;
        //$country->country_name_arabic = $request->country_name_arabic;
        //$country->phone_count = $request->phone_count;
        if($request->image!=""){
            if($request->file('image')!=""){
            $image = $request->file('image');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $country->image = $upload_image;
            }
        }

        $country->save();
        return response()->json('successfully save'); 
    }

    public function updateCountry(Request $request){
        $this->validate($request, [
            'country_code'=>'required',
            'country_name_english'=>'required',
            //'country_name_arabic'=>'required',
            //'phone_count'=>'required',
            'image' => 'mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            //'image.required' => 'Item Image Field is Required',
        ]);
        
        $country = country::find($request->id);
        $country->country_code = $request->country_code;
        $country->country_name_english = $request->country_name_english;
        //$country->country_name_arabic = $request->country_name_arabic;
        //$country->phone_count = $request->phone_count;
        if($request->image!=""){
            $old_image = "upload_files/".$country->image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            if($request->file('image')!=""){
            $image = $request->file('image');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $country->image = $upload_image;
            }
        }
        $country->save();
        return response()->json('successfully update'); 
    }

    public function Country(){
        $country = country::all();
        $language = language::all();
        return view('admin.country',compact('country','language'));
    }

    public function editCountry($id){
        $country = country::find($id);
        return response()->json($country); 
    }
    
    public function deleteCountry($id,$status){
        $country = country::find($id);
        $country->status = $status;
        $country->save();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }
}
