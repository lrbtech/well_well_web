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
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ShipmentExport implements FromCollection, ShouldAutoSize , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($status,$user_type,$fdate,$tdate)
    {
        $this->fdate = $fdate;
        $this->tdate = $tdate;
        $this->status = $status;
        $this->user_type = $user_type;
    }

    public function collection()
    {
        $i =DB::table('shipments');
        if ( $this->fdate != '1970-01-01' && $this->tdate != '1970-01-01' )
        {
            //$i->whereBetween('shipments.date', [$this->fdate, $this->tdate]);
            $tdate1 = $this->tdate;
            $fdate1 = $this->fdate;
            $i->where(function($query) use ($tdate1,$fdate1){
                $query->where([
                    ['status',1],
                    ['pickup_assign_date','<=',$tdate1],
                    ['pickup_assign_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',2],
                    ['package_collect_date','<=',$tdate1],
                    ['package_collect_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',3],
                    ['exception_assign_date','<=',$tdate1],
                    ['exception_assign_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',4],
                    ['transit_in_date','<=',$tdate1],
                    ['transit_in_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',11],
                    ['transit_in_date','<=',$tdate1],
                    ['transit_in_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',6],
                    ['transit_out_date','<=',$tdate1],
                    ['transit_out_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',12],
                    ['transit_out_date','<=',$tdate1],
                    ['transit_out_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',13],
                    ['package_at_station_date','<=',$tdate1],
                    ['package_at_station_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',14],
                    ['package_at_station_date','<=',$tdate1],
                    ['package_at_station_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',7],
                    ['van_scan_date','<=',$tdate1],
                    ['van_scan_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',8],
                    ['delivery_date','<=',$tdate1],
                    ['delivery_date','>=',$fdate1],
                ]);
                $query->orWhere([
                    ['status',9],
                    ['delivery_exception_assign_date','<=',$tdate1],
                    ['delivery_exception_assign_date','>=',$fdate1],
                ]);
            });
        }
        if ( $this->user_type != 'all_user' )
        {
            if ( $this->user_type != 'guest' ){
                $i->where('shipments.sender_id', $this->user_type);
                //$i->join('users', 'users.id', '=', 'shipments.sender_id');
            }
            else{
                $i->where('shipments.sender_id', 0);
            }
        }
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


        $shipment_package = shipment_package::where('shipment_id',$shipment->id)->get();

        $user_details='';
        if($shipment->sender_id == '0'){
            $address = manage_address::find($shipment->from_address);
            $user_details=$address->contact_name . $address->contact_mobile;
        }
        else{
            $user_details=$user->name . $user->mobile . $user->email;
        }

        $account_id='';
        if($shipment->sender_id == '0'){
            $account_id='GUEST';
        }
        else{
            $account_id = $user->customer_id;
        }

        $shipment_details = 'No of Packages : ' .$shipment->no_of_packages . 
        'Total Weight ' .$shipment->total_weight . ' Kg';
        
        return [
            $user_details,
            $account_id,
            $shipment_package[0]->sku_value,
            //$shipment->reference_no,
            $shipment->date,
            $shipment_details,
            $ship_from,
            $ship_to,
            $shipment->special_cop,
            $shipment->special_cod,
        ];
    }


    public function headings(): array
    {
        return [
            'User Details',
            'Account ID',
            'Tracking ID',
            //'Reference No',
            'Date',
            'Shipment Details',
            'Shipment From',
            'Shipment To',
            'C.O.P',
            'C.O.D',
        ];
    }


}
