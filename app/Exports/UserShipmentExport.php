<?php

namespace App\Exports;
use App\Models\drop_point;
use App\Models\country;
use App\Models\city;
use App\Models\shipment_category;
use App\Models\package_category;
use App\Models\manage_address;
use App\Models\shipment;
use App\Models\shipment_package;
use App\Models\shipment_notes;
use App\Models\shipment_notification;
use App\Models\User;
use App\Models\add_rate;
use App\Models\add_rate_item;
use App\Models\agent;
use App\Models\station;
use App\Models\language;
use DB;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserShipmentExport implements FromCollection, ShouldAutoSize , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($status,$fdate,$tdate,$user_id)
    {
        $this->fdate = $fdate;
        $this->tdate = $tdate;
        $this->status = $status;
        $this->user_id = $user_id;
    }

    public function collection()
    {
        $i =DB::table('shipments');
        if ( $this->status != 20 )
        {
            if ( $this->status == 4 ){
                $i->where('shipments.status', 4);
                $i->orWhere('shipments.status', 11);
            }
            elseif ( $this->status == 6 ){
                $i->where('shipments.status', 6);
                $i->orWhere('shipments.status', 12);
            }
            else{
                $i->where('shipments.status', $this->status);
            }
        }
        if ( $this->fdate != '1970-01-01' && $this->tdate != '1970-01-01' )
        {
            $i->whereBetween('shipments.date', [$this->fdate, $this->tdate]);
        }
        $i->where('shipments.sender_id',$this->user_id);
        $i->orderBy('shipments.id','DESC');
        return $shipment = $i->get();
        //return booking::query()->whereYear('created_at', $this->fdate);
    }

    public function map($shipment): array
    {
        $shipment_mode='';
        if($shipment->shipment_mode == 1){
            $shipment_mode='Standard';
        }
        elseif($shipment->shipment_mode == 2){
            $shipment_mode='Express';
        }

        $from_address = manage_address::find($shipment->from_address);
        $from_city = city::find($from_address->city_id);
        $from_area = city::find($from_address->area_id);
        $from_station = station::find($shipment->from_station_id);
        $user = User::find($shipment->sender_id);
        
        $ship_from='';
        if(!empty($from_area)){
            $ship_from = $from_area->city . $from_city->city . ' Station :' . $from_station->station;
        }

        $to_address = manage_address::find($shipment->to_address);
        $to_city = city::find($to_address->city_id);
        $to_area = city::find($to_address->area_id);
        $to_station = station::find($shipment->to_station_id);

        $ship_to='';
        if(!empty($to_area)){
            $ship_to = $to_area->city . $to_city->city . 'Station :' . $to_station->station;
        }

        $status='';
        if($shipment->status == 0){
            $status='Ready for Pickup';
        }
        elseif($shipment->status == 1){
            $status='Schedule for Pickup';
        }
        elseif($shipment->status == 2){
            $status='Package Collected';
        }
        elseif($shipment->status == 3){
            $status='
            Pickup Exception
            ' . $shipment->exception_category . '
            ' . $shipment->exception_remark . '
            ';
        }
        elseif($shipment->status == 4){
            $from_station = station::find($shipment->from_station_id);
            $status='Transit In '.$from_station->station.'';
        }
        elseif($shipment->status == 11){
            $to_station = station::find($shipment->to_station_id);
            $status='Transit In '.$to_station->station.'';
        }
        elseif($shipment->status == 6){
            $from_station = station::find($shipment->from_station_id);
            $status='Transit Out '.$from_station->station.'';
        }
        elseif($shipment->status == 12){
            $to_station = station::find($shipment->to_station_id);
            $status='Transit Out '.$to_station->station.'';
        }
        elseif($shipment->status == 7){
            $status='In the Van for Delivery';
        }
        elseif($shipment->status == 8){
            $status='Shipment delivered';
        }
        elseif($shipment->status == 9){
            $status='
            Delivery Exception
            ' . $shipment->delivery_exception_category . '
            ' . $shipment->delivery_exception_remark . '
            ';
        }
        elseif($shipment->status == 10){
            $status='
            Canceled
            ' . $shipment->cancel_remark . '';
        }

        $special_service='';
        if ($shipment->special_service == 1) {
            $special_service.='Special Service';
            $special_service.=$shipment->special_service_description;
        }

        $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();
        $user_type='';
        if($shipment->sender_id == '0'){
            $user_type='Guest';
        }
        else{
            if($user->user_type == '0'){
                $user_type='Individual';
            }
            elseif($user->user_type == '1'){
                $user_type='Commercial';
            }
        }

        $user_details='';
        if($shipment->sender_id == '0'){
            $address = manage_address::find($shipment->from_address);
            $user_details=$address->contact_name . $address->contact_mobile;
        }
        else{
            $user_details=$user->name . $user->mobile . $user->email;
        }

        $shipment_details = 'No of Packages : ' .$shipment->no_of_packages . 
        'Total Weight ' .$shipment->total_weight . ' Kg';
        
        return [
            $shipment_package[0]->sku_value,
            $shipment->reference_no,
            $shipment->date,
            $shipment_mode,
            $shipment_details,
            $ship_from,
            $ship_to,
            $shipment->total,
            $shipment->special_cod,
        ];
    }


    public function headings(): array
    {
        return [
            'Tracking ID',
            'Reference No',
            'Date',
            'Shipping Mode',
            'Shipment Details',
            'Ship From',
            'Ship To',
            'Shipment Price',
            'Special C.O.D',
        ];
    }


}

