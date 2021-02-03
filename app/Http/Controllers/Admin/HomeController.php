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
use App\Models\shipment_notification;
use App\Models\User;
use App\Models\add_rate;
use App\Models\add_rate_item;
use Auth;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard(){
        $total_shipment = shipment::count();
        $total_individual = User::where('user_type','0')->count();
        $total_business = User::where('user_type','1')->count();
        $today = date('Y-m-d');
        $cfdate = date('Y-m-d',strtotime('first day of this month'));
        $cldate = date('Y-m-d',strtotime('last day of this month'));

        $shipment = shipment::orderBy('id', 'desc')->take('5')->get();
        $current_month_value = shipment::whereBetween('date', [$cfdate, $cldate])->get()->sum("total");
        return view('admin.dashboard',compact('total_shipment','shipment','current_month_value','total_individual','total_business'));
    }
}
