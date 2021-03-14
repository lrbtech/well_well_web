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
            $pickup_assigned=0;
            $pickup_exception=0;
            $package_collected=0;
            $transit_in=0;
            $transit_out=0;
            $package_at_station=0;
            $van_for_delivery=0;
            $delivery_exception=0;
            $shipment_delivered=0;
            $today_delivery=0;
            $future_delivery=0;
            if(Auth::guard('admin')->user()->station_id == '0'){
                $today = date('Y-m-d');
                $q =DB::table('shipments as s');
                $q->where('s.shipment_date', $today);
                $q->where('s.status', 0);
                $q->where('s.sender_id','!=',0);
                $q->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
                $q->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
                $today_pickup_request1 = $q->get();

                $q1 =DB::table('shipments as s');
                $q1->where('s.shipment_date','!=',$today);
                $q1->where('s.status', 0);
                $q1->where('s.sender_id','!=',0);
                $q1->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
                $q1->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
                $future_pickup_request1 = $q1->get();

                $new_shipment_request = shipment::where('status',0)->where('sender_id','!=',0)->orderBy('id','DESC')->count();

                $guest_pickup_request = shipment::where('status',0)->where('sender_id',0)->orderBy('id','DESC')->count();

                $pickup_assigned = shipment::where('status',1)->orderBy('id', 'DESC')->where('hold_status',0)->count();

                $i =DB::table('shipments');
                $i->where('shipments.status',3);
                $i->where('shipments.hold_status',0);
                $i->orderBy('shipments.id','DESC');
                $pickup_exception = $i->count();

                $package_collected=shipment::where('status',2)->where('hold_status',0)->orderBy('id', 'DESC')->count();
                $transit_in=shipment::where('status',4)->orWhere('status',11)->where('hold_status',0)->orderBy('id', 'DESC')->count();
                $transit_out=shipment::where('status',6)->orWhere('status',12)->where('hold_status',0)->orderBy('id', 'DESC')->count();
                $package_at_station=shipment::where('status',13)->orWhere('status',14)->where('hold_status',0)->orderBy('id', 'DESC')->count();
                $van_for_delivery=shipment::where('status',7)->where('hold_status',0)->orderBy('id', 'DESC')->count();

                $i1 =DB::table('shipments');
                $i1->where('shipments.status',9);
                $i1->where('shipments.hold_status',0);
                $i1->orderBy('shipments.id','DESC');
                $delivery_exception = $i1->count();

                $shipment_delivered=shipment::where('status',8)->where('hold_status',0)->orderBy('id', 'DESC')->count();

                $i2 =DB::table('shipments');
                $i2->where('shipments.delivery_reschedule',1);
                $i2->where('shipments.delivery_reschedule_date',$today);
                $i2->where('shipments.hold_status',0);
                $i2->orderBy('shipments.id','DESC');
                $today_delivery = $i2->count();

                $i3 =DB::table('shipments');
                $i3->where('shipments.delivery_reschedule',1);
                $i3->where('shipments.delivery_reschedule_date','!=',$today);
                $i3->where('shipments.hold_status',0);
                $i3->orderBy('shipments.id','DESC');
                $future_delivery = $i3->count();
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
                $today_pickup_request1 = $q->get();

                $q1 =DB::table('shipments as s');
                $q1->where('s.from_station_id', Auth::guard('admin')->user()->station_id);
                $q1->where('s.shipment_date','!=',$today);
                $q1->where('s.status', 0);
                $q1->where('s.sender_id','!=',0);
                $q1->groupBy('s.sender_id','s.shipment_date','s.from_address','s.shipment_from_time','s.shipment_to_time');
                $q1->select([DB::raw("SUM(s.no_of_packages) as no_of_packages") ,DB::raw("COUNT(s.id) as no_of_shipments") , DB::raw("s.from_address") , DB::raw("s.sender_id") , DB::raw("s.shipment_from_time") , DB::raw("s.shipment_to_time") , DB::raw("s.shipment_date")  ]);
                $future_pickup_request1 = $q1->get();

                $new_shipment_request = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('sender_id','!=',0)->where('status',0)->orderBy('id','DESC')->count();

                $guest_pickup_request = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('sender_id',0)->where('status',0)->orderBy('id','DESC')->count();

                $pickup_assigned = shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',1)->orderBy('id', 'DESC')->where('hold_status',0)->count();

                $i =DB::table('shipments');
                $i->where('shipments.status',3);
                $i->where('shipments.hold_status',0);
                $i->where('shipments.from_station_id',Auth::guard('admin')->user()->station_id);
                $i->orderBy('shipments.id','DESC');
                $pickup_exception = $i->count();
                
                $package_collected=shipment::where('from_station_id',Auth::guard('admin')->user()->station_id)->where('status',2)->where('hold_status',0)->orderBy('id', 'DESC')->count();
                $transit_in=DB::table('shipments')
                    ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','4']])
                    ->orWhere([['from_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','11']])
                    ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','4']])
                    ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','11']])
                    ->where('hold_status',0)->orderBy('id', 'DESC')
                    ->count();
                $transit_out=DB::table('shipments')
                    ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','6']])
                    ->orWhere([['from_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','12']])
                    ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','6']])
                    ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','12']])
                    ->where('hold_status',0)->orderBy('id', 'DESC')
                    ->count();
                $package_at_station=DB::table('shipments')
                    ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','13']])
                    ->orWhere([['from_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','14']])
                    ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','13']])
                    ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','14']])
                    ->where('hold_status',0)->orderBy('id', 'DESC')
                    ->count();
                $van_for_delivery=DB::table('shipments')
                    ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','7']])
                    ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','7']])
                    ->where('hold_status',0)->orderBy('id', 'DESC')
                    ->count();

                $i1 =DB::table('shipments');
                $i1->where([['shipments.from_station_id',Auth::guard('admin')->user()->station_id],
                        ['shipments.status','9']]);
                $i1->orWhere([['shipments.to_station_id',Auth::guard('admin')->user()->station_id],
                        ['shipments.status','9']]);
                $i1->where('shipments.hold_status',0);
                $i1->orderBy('shipments.id','DESC');
                $delivery_exception = $i1->count();

                $shipment_delivered=DB::table('shipments')
                    ->where([['from_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','8']])
                    ->orWhere([['to_station_id',Auth::guard('admin')->user()->station_id],
                            ['status','8']])
                    ->where('hold_status',0)->orderBy('id', 'DESC')
                    ->count();
                
                $i2 =DB::table('shipments');
                $i2->where([['shipments.from_station_id',Auth::guard('admin')->user()->station_id],['shipments.delivery_reschedule',1],['shipments.delivery_reschedule_date',$today]]);
                $i2->orWhere([['shipments.to_station_id',Auth::guard('admin')->user()->station_id],['shipments.delivery_reschedule',1],['shipments.delivery_reschedule_date',$today]]);
                $i2->where('shipments.hold_status',0);
                $i2->orderBy('shipments.id','DESC');
                $today_delivery = $i2->count();
                
                $i3 =DB::table('shipments');
                $i3->where([['shipments.from_station_id',Auth::guard('admin')->user()->station_id],['shipments.delivery_reschedule',1],['shipments.delivery_reschedule_date','!=',$today]]);
                $i3->orWhere([['shipments.to_station_id',Auth::guard('admin')->user()->station_id],['shipments.delivery_reschedule',1],['shipments.delivery_reschedule_date','!=',$today]]);
                $i3->where('shipments.hold_status',0);
                $i3->orderBy('shipments.id','DESC');
                $future_delivery = $i3->count();

            }
            foreach($future_pickup_request1 as $row){
                $future_pickup_request++;
            }
            foreach($today_pickup_request1 as $row){
                $today_pickup_request++;
            }

            $role_get = role::where('id','=',Auth::guard('admin')->user()->role_id)->first();

            $view->with(compact('role_get','today_pickup_request','new_shipment_request','future_pickup_request','guest_pickup_request','role_get','pickup_assigned','pickup_exception','package_collected','transit_in','transit_out','package_at_station','van_for_delivery','delivery_exception','shipment_delivered','today_delivery','future_delivery'));
        });
    }
}
