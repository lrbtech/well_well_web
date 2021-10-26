<?php

namespace App\Imports;

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
use App\Models\temp_shipment;
use App\Models\temp_shipment_package;
use App\Models\ship_now_mobile_verify;
use Hash;
use Mail;
use PDF;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;   

class ShipmentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new shipment([
        //     //
        // ]);
        $account_id = $row['account_id'];
        $user = User::where('customer_id',$account_id)->where('status',4)->first();
        if(empty($user)){
            return response()->json(['message' => 'Account ID Not Found'], 401);
        }
        else{
            $from_address = new manage_address;
            $from_address->user_id = $user->id;
            $from_address->from_to = 1;
            $from_city = city::where('parent_id',0)->where('city',$row['pick_up_city'])->first();
            $from_address->city_id = $from_city->id;
            $from_area = city::where('parent_id',$from_city->id)->where('city',$row['pick_up_area'])->first();
            $from_address->area_id = $from_area->id;
            $from_address->country_id = 1;
            $from_address->contact_name = $row['pick_up_name'];
            $from_address->contact_mobile = $row['pick_up_mobile'];
            $from_address->contact_landline = $row['pick_up_land_line'];
            $from_address_type=0;
            if($row['pick_up_address_type'] == 'Home'){
                $from_address_type=1;
            }
            elseif($row['pick_up_address_type'] == 'Office'){
                $from_address_type=2;
            }
            elseif($row['pick_up_address_type'] == 'Other'){
                $from_address_type=3;
            }
            $from_address->address_type = $from_address_type;
            $from_address->latitude = $row['pick_up_latitude'];
            $from_address->longitude = $row['pick_up_longitude'];
            $from_address->address1 = $row['pick_up_address'];
            $from_address->save();


            $to_address = new manage_address;
            $to_address->user_id = $user->id;
            $to_address->from_to = 2;
            $to_city = city::where('parent_id',0)->where('city',$row['delivery_city'])->first();
            $to_address->city_id = $to_city->id;
            $to_area = city::where('parent_id',$to_city->id)->where('city',$row['delivery_area'])->first();
            $to_address->area_id = $to_area->id;
            $to_address->country_id = 1;
            $to_address->contact_name = $row['delivery_name'];
            $to_address->contact_mobile = $row['delivery_mobile'];
            $to_address->contact_landline = $row['delivery_land_line'];
            $to_address_type=0;
            if($row['delivery_address_type'] == 'Home'){
                $to_address_type=1;
            }
            elseif($row['delivery_address_type'] == 'Office'){
                $to_address_type=2;
            }
            elseif($row['delivery_address_type'] == 'Other'){
                $to_address_type=3;
            }
            $to_address->address_type = $to_address_type;
            $to_address->latitude = $row['delivery_latitude'];
            $to_address->longitude = $row['delivery_longitude'];
            $to_address->address1 = $row['delivery_address'];
            $to_address->save();
            
            $from_station = city::find($from_city->id);
            $to_station = city::find($to_city->id);

            $config = [
                'table' => 'shipments',
                'field' => 'order_id',
                'length' => 6,
                'prefix' => '0'
            ];
    
            $order_id = IdGenerator::generate($config);

            $shipment = new shipment;
            $shipment->order_id = $order_id;
            $shipment->date = date('Y-m-d');
            $shipment->sender_id = $user->id;
            $shipment->shipment_type = 1;
            $shipment->shipment_date = date('Y-m-d',strtotime($row['shipment_date']));
            $shipment->shipment_from_time = $row['shipment_from_time'];
            $shipment->shipment_to_time = $row['shipment_to_time'];
            $shipment->from_address = $from_address->id;
            $shipment->to_address = $to_address->id;
            $shipment->from_station_id = $from_station->station_id;
            $shipment->to_station_id = $to_station->station_id;
            $shipment->shipment_mode = $row['shipment_mode'];
            $shipment->return_package_cost = 2;
            $shipment->special_cod_enable = $row['cod_enable'];
            $shipment->special_cod = $row['cod_value'];
            $shipment->no_of_packages = $row['no_of_packages'];
            $shipment->declared_value = $row['declared_value'];
            $shipment->reference_no = $row['reference'];
            $shipment->identical = 0;

            $total_weight=0;
            $dimension = ($row['length'] * $row['width'] * $row['height']) / 5000;
            $chargeable_weight=0;
            if($dimension > $row['weight']){
                $chargeable_weight = $dimension;
            }
            else{
                $chargeable_weight = $row['weight'];
            }  
            $total_weight = $total_weight + $chargeable_weight;
            
            $shipment->total_weight = $total_weight;
            
            $cod_enable;
            if($row['cod_enable'] == '1'){
                $cod_enable = 1;
            }
            else{
                $cod_enable=0;
            }
            
            $price = $this->getShipmentPrice($user->id,$total_weight,$to_address->id,$row['shipment_mode'],$row['declared_value'],$cod_enable);


            $shipment->shipment_price = $price->original['shipment_price'];
            $shipment->postal_charge_percentage = $price->original['postal_charge_percentage'];
            $shipment->postal_charge = $price->original['postal_charge'];
            $shipment->sub_total = $price->original['sub_total'];
            $shipment->vat_percentage = $price->original['vat_percentage'];
            $shipment->vat_amount = $price->original['vat_amount'];
            $shipment->insurance_percentage = $price->original['insurance_percentage'];
            $shipment->insurance_amount = $price->original['insurance_amount'];
            $shipment->cod_amount = $price->original['cod_amount'];
            $shipment->total = $price->original['total'];
            
            $shipment->save();

            $sku_value =  $this->generateSkuValue();

            $shipment_package = new shipment_package;
            $shipment_package->shipment_id = $shipment->id;
            $shipment_package->sku_value = $sku_value;
            $shipment_package->category = $row['category'];
            $shipment_package->description = $row['description'];
            $shipment_package->weight = $row['weight'];
            $shipment_package->length = $row['length'];
            $shipment_package->width = $row['width'];
            $shipment_package->height = $row['height'];
            $dimension = ($row['length'] * $row['width'] * $row['height']) / 5000;
            $chargeable_weight=0;
            if($dimension > $row['weight']){
                $chargeable_weight = $dimension;
            }
            else{
                $chargeable_weight = $row['weight'];
            }  
            $shipment_package->chargeable_weight = $chargeable_weight;
            $shipment_package->save();

        }
    }


    public function generateSkuValue(){
        $sku_value = mt_rand( 1000000000, 9999999999);
        if(DB::table( 'shipment_packages' )->where( 'sku_value', $sku_value )->exists()){
            $this->generateSkuValue();
        }
        else{
            if(DB::table( 'temp_shipment_packages' )->where( 'sku_value', $sku_value )->exists()){
                $this->generateSkuValue();
            }
            else{
                return $sku_value;
            }
        }
    }

    public function getShipmentPrice($user_id,$weight,$to_address,$shipment_mode,$declared_value,$cod_enable){
        $rate = add_rate::where('user_id',$user_id)->first();
        $address = manage_address::find($to_address);
        $area = city::find($address->area_id);
        $data =array();

        $price=0;
        if($area->remote_area == '0'){
            if('0' <= $weight && '5' >= $weight && $shipment_mode == '1'){
                $price = $rate->service_area_0_to_5_kg_price;
            }
            elseif('5.1' <= $weight && '10' >= $weight && $shipment_mode == '1'){
                $price = $rate->service_area_5_to_10_kg_price;
            }
            elseif('10.1' <= $weight && '15' >= $weight && $shipment_mode == '1'){
                $price = $rate->service_area_10_to_15_kg_price;
            }
            elseif('15.1' <= $weight && '20' >= $weight && $shipment_mode == '1'){
                $price = $rate->service_area_15_to_20_kg_price;
            }
            elseif('20.1' <= $weight && '99999' >= $weight && $shipment_mode == '1'){
                $price = (($weight - 20) * $rate->service_area_20_to_1000_kg_price) + $rate->service_area_15_to_20_kg_price; 
            }
            elseif('0' <= $weight && '5' >= $weight && $shipment_mode == '2'){
                $price = $rate->same_day_delivery_0_to_5_kg_price;
            }
            elseif('5.1' <= $weight && '10' >= $weight && $shipment_mode == '2'){
                $price = $rate->same_day_delivery_5_to_10_kg_price;
            }
            elseif('10.1' <= $weight && '15' >= $weight && $shipment_mode == '2'){
                $price = $rate->same_day_delivery_10_to_15_kg_price;
            }
            elseif('15.1' <= $weight && '10' >= $weight && $shipment_mode == '2'){
                $price = $rate->same_day_delivery_15_to_20_kg_price;
            }
            elseif('20.1' <= $weight && '999999' >= $weight && $shipment_mode == '2'){
                $price = (($weight - 20) * $rate->same_day_delivery_20_to_1000_kg_price) + $rate->same_day_delivery_15_to_20_kg_price;
            }
        }
        else{
            $price1=0;
            if($shipment_mode == '1'){
                $price1 = $rate->service_area_0_to_5_kg_price;
            }
            elseif($shipment_mode == '2'){
                $price1 = $rate->same_day_delivery_0_to_5_kg_price;
            }
            if('0' <= $weight && '5' >= $weight){
                $price = $rate->before_5_kg_price + $price1;
            }
            else{
                $price = (($weight - 5) * $rate->above_5_kg_price) + $rate->before_5_kg_price + $price1;
            }
        }

        $insurance_amount = 0;
        $cod_amount = 0;
        $vat_amount = 0;
        $postal_charge = 0;

        $settings = settings::find('1');
        if($rate->insurance_enable == 1){
            $insurance_amount = ($settings->insurance_percentage/100) * $declared_value;
        }
        
        if($rate->cod_enable == 1){
            $cod_amount = $rate->cod_price;
        }

        $sub_total = $price + $insurance_amount + $cod_amount;

        if($rate->vat_enable == 1){
        $vat_amount = ($settings->vat_percentage/100) * $sub_total;
        }
    
        if($rate->postal_charge_enable == 1){
            if($weight >= 30){
                $postal_charge = 0;
            }
            else{
                $postal_charge = ($settings->postal_charge_percentage/100) * $price;
                if($postal_charge < 2){
                    $postal_charge = 2;
                }
            }
        }

        $total = $sub_total + $vat_amount + $postal_charge;

        $data = array(
            'shipment_price' => round($price,2),
            'postal_charge_percentage' => round($settings->postal_charge_percentage,2),
            'postal_charge' => round($postal_charge,2),
            'cod_amount' => round($cod_amount,2),
            'sub_total' => round($sub_total,2),
            'vat_percentage' => round($settings->vat_percentage,2),
            'vat_amount' => round($vat_amount,2),
            'insurance_percentage' => round($settings->insurance_percentage,2),
            'insurance_amount' => round($insurance_amount,2),
            'total' => round($total,2),
        );

        return response()->json($data);
    }



}
