<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\role;
use App\Models\shipment;
use App\Models\shipment_package;
use Auth;
use App\Models\language;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('admin.layouts', function($view) {
    
            $role_get = role::find(Auth::guard('admin')->user()->role_id);
            $today_pickup_request = 0;
            $future_pickup_request = 0;
            $new_shipment_request = 0;
            $guest_pickup_request = 0;
            $today_pickup_request1=0;
            $future_pickup_request1=0;
            if(Auth::guard('admin')->user()->station_id == '0'){
                $today = date('Y-m-d');
                $q =DB::table('shipments as s');
                $q->where('s.shipment_date', $today);
                $q->where('s.status', 0);
                $q->where('s.sender_id','!=',0);
                $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
                $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
                $today_pickup_request = $q->count();

                $q1 =DB::table('shipments as s');
                $q1->where('s.shipment_date','!=',$today);
                $q1->where('s.status', 0);
                $q1->where('s.sender_id','!=',0);
                $q1->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
                $q1->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
                $future_pickup_request = $q1->count();

                $new_shipment_request = shipment::where('status',0)->where('sender_id','!=',0)->orderBy('id','DESC')->count();

                $guest_pickup_request = shipment::where('status',0)->where('sender_id',0)->orderBy('id','DESC')->count();
            }
            else{
                $today = date('Y-m-d');
                $q =DB::table('shipments as s');
                $q->where('s.from_station_id', Auth::guard('admin')->user()->station_id);
                $q->where('s.shipment_date',$today);
                $q->where('s.status', 0);
                $q->where('s.sender_id','!=',0);
                $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
                $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")]);
                $today_pickup_request = $q->count();

                $q1 =DB::table('shipments as s');
                $q1->where('s.from_station_id', Auth::guard('admin')->user()->station_id);
                $q1->where('s.shipment_date','!=',$today);
                $q1->where('s.status', 0);
                $q1->where('s.sender_id','!=',0);
                $q1->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
                $q1->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
                $future_pickup_request = $q1->count();

                $new_shipment_request = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('sender_id','!=',0)->where('status',0)->orderBy('id','DESC')->count();

                $guest_pickup_request = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('sender_id',0)->where('status',0)->orderBy('id','DESC')->count();
            }
            // foreach($future_pickup_request1 as $row){
            //     $future_pickup_request++;
            // }
            // foreach($today_pickup_request1 as $row){
            //     $today_pickup_request++;
            // }
            $view->with(compact('role_get','today_pickup_request','new_shipment_request','future_pickup_request','guest_pickup_request'));
        });
    }
}
