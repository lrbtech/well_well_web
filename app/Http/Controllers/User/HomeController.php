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
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
        $total_shipment = shipment::where('sender_id',Auth::user()->id)->count();
        $today = date('Y-m-d');
        $cfdate = date('Y-m-d',strtotime('first day of this month'));
        $cldate = date('Y-m-d',strtotime('last day of this month'));

        $shipment = shipment::where('sender_id',Auth::user()->id)->orderBy('id', 'desc')->take('5')->get();
        $current_month_value = shipment::whereBetween('date', [$cfdate, $cldate])->get()->sum("total");
        return view('user.dashboard',compact('total_shipment','shipment','current_month_value'));
    }
    
}
