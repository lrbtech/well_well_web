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
use Hash;
use Mail;
use PDF;
use DB;

class UserApiController extends Controller
{
    public function Tracking(Request $request){ 
        try{
            //$check1 = shipment_package::where('sku_value',$request->barcode)->get();

            $q =DB::table('shipment_packages as sp');
            $q->where('sp.sku_value', $request->sku_value);
            $q->join('shipments as s','s.id','=','sp.shipment_id');
            $q->select('s.*','sp.sku_value');
            $check1 = $q->get();
        
            if(count($check1)>0){
            $from_address =manage_address::find($check1[0]->from_address);
            $to_address =manage_address::find($check1[0]->to_address);

            $from_area = city::find($from_address->area_id);
            $from_city = city::find($from_address->city_id);
            $to_area = city::find($to_address->area_id);
            $to_city = city::find($to_address->city_id);

                $data = array(
                    'id'=>$check1[0]->id,
                    'sku_value'=>$check1[0]->sku_value,
                    'from_area'=>$from_area->city,
                    'from_city'=>$from_city->city,
                    'to_area'=>$to_area->city,
                    'to_city'=>$to_city->city,
                    'status'=>$check1[0]->status,
                    'mode'=>'',
                    );
                if($check1[0]->shipment_mode == 1){
                    $data['mode'] = 'standard';
                }
                else{
                    $data['mode'] = 'express';
                }
                $datas[]=$data;
                return response()->json($datas, 200);

            }else{
                return response()->json(['message' => 'Shipment Not Available','status'=>403], 403);
            }
        
        }catch (\Exception $e) {
            return response()->json($e);
            return response()->json(['message' => 'Shipment Not Available','status'=>400], 400);
        }
    }

    public function trackHistory($id){
        $shipment = shipment::find($id);
        $data =array();
        $from_station = station::find($shipment->from_station_id);
        $to_station = station::find($shipment->to_station_id);
        $data = array(
            'date_time' => '',
            'value' => '',
        );
        if($shipment->status != 10){
            if($shipment->status == 9 && $shipment->status < 11 && $shipment->status != 10){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->delivery_exception_assign_date)) .'-'. date('H:m a',strtotime($shipment->delivery_exception_assign_time));
                $data['value'] = $shipment->delivery_exception_category .'-'. $shipment->delivery_exception_remark;
                $datas[] = $data;
            }
            if($shipment->status >= 8 && $shipment->status < 11 && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->delivery_date)) .'-'. date('H:m a',strtotime($shipment->delivery_time));
                $data['value'] = 'Shipment Delivered';
                $datas[] = $data;
            }
            if($shipment->status >= 7 && $shipment->status < 11 && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->van_scan_date)) .'-'. date('H:m a',strtotime($shipment->van_scan_time));
                $data['value'] = 'In the Van for Delivery';
                $datas[] = $data;
            }
            if(6 < $shipment->status && 12 == $shipment->status && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->transit_out_date)) .'-'. date('H:m a',strtotime($shipment->transit_out_time));
                $data['value'] = 'Transit Out' . $to_station->station;
                $datas[] = $data;
            }
            if(6 < $shipment->status && 11 == $shipment->status && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->transit_in_date)) .'-'. date('H:m a',strtotime($shipment->transit_in_time));
                $data['value'] = 'Transit In' . $to_station->station;
                $datas[] = $data;
            }
            if($shipment->status >= 6 && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->transit_out_date)) .'-'. date('H:m a',strtotime($shipment->transit_out_time));
                $data['value'] = 'Transit Out' . $to_station->station;
                $datas[] = $data;
            }
            if($shipment->status >= 4 && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->transit_in_date)) .'-'. date('H:m a',strtotime($shipment->transit_in_time));
                $data['value'] = 'Transit In' . $to_station->station;
                $datas[] = $data;
            }
            if($shipment->status == 3 && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->exception_assign_date)) .'-'. date('H:m a',strtotime($shipment->exception_assign_time));
                $data['value'] = $shipment->eception_category .'-'. $shipment->eception_remark;
                $datas[] = $data;
            }
            if($shipment->status >= 2 && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->package_collect_date)) .'-'. date('H:m a',strtotime($shipment->package_collect_time));
                $data['value'] = 'Package Collected';
                $datas[] = $data;
            }
            if($shipment->status >= 1 && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y',strtotime($shipment->pickup_assign_date)) .'-'. date('H:m a',strtotime($shipment->pickup_assign_time));
                $data['value'] = 'Schedule for Pickup';
                $datas[] = $data;
            }
            if($shipment->status >= 0 && $shipment->status != 10 && $shipment->status != 9){
                $data['date_time'] = date('d-m-Y H:m a',strtotime($shipment->created_at));
                $data['value'] = 'Shipment Created';
                $datas[] = $data;
            }
        }else{
            $data['date_time'] = date('d-m-Y',strtotime($shipment->cancel_request_date)) .'-'. date('H:m a',strtotime($shipment->cancel_request_time));
            $data['value'] = 'Shipment Canceled';
            $datas[] = $data;
        }
        return response()->json($datas); 
    }


}
