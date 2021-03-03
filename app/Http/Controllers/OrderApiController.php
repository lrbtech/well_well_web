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
use App\Models\add_rate;
use App\Models\add_rate_item;
use App\Models\settings;
use App\Models\common_price;
use App\Models\revenue_exception_log;
use App\Models\system_logs;
use App\Models\guest_user;
use App\Models\ship_now_mobile_verify;
use Hash;
use Mail;
use PDF;
use DB;

class OrderApiController extends Controller
{
    public function getArea(Request $request){ 
        return response()->json(['message' => 'Unauthorized Access','status'=>419], 419);
    }
    public function createOrder(Request $request){ 
        return response()->json(['message' => 'Unauthorized Access','status'=>419], 419);
    }
}
