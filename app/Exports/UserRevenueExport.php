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

class UserRevenueExport implements FromCollection, ShouldAutoSize , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($fdate,$tdate)
    {
        $this->fdate = $fdate;
        $this->tdate = $tdate;
    }

    public function collection()
    {
        // if($this->fdate != '1970-01-01' && $this->tdate != '1970-01-01'){
        //     $shipment = shipment::whereBetween('date', [$this->fdate, $this->tdate])->orderBy('id','DESC')->get();
        // }else{
        //     $shipment = shipment::orderBy('id','desc')->get();
        // }
        $i =DB::table('shipments');
        if ( $this->fdate != '1970-01-01' && $this->tdate != '1970-01-01' )
        {
            $i->whereBetween('shipments.date', [$this->fdate, $this->tdate]);
        }
        $i->where('shipments.sender_id',Auth::user()->id);
        $i->orderBy('shipments.id','DESC');
        $shipment = $i->get();
        return $shipment;
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
        if(!empty($from_area->city)){
            $ship_from = $from_area->city . $from_city->city . ' Station :' . $from_station->station;
        }

        $to_address = manage_address::find($shipment->to_address);
        $to_city = city::find($to_address->city_id);
        $to_area = city::find($to_address->area_id);
        $to_station = station::find($shipment->to_station_id);

        $ship_to='';
        if(!empty($to_area->city)){
            $ship_to = $to_area->city . $to_city->city . 'Station :' . $to_station->station;
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
            $shipment->order_id,
            $shipment->date,
            $user_type,
            $user_details,
            $shipment_mode,
            $special_service,
            $shipment_details,
            $ship_from,
            $ship_to,
            'AED '.$shipment->shipment_price,
            'AED '.$shipment->insurance_amount,
            'AED '.$shipment->cod_amount,
            'AED '.$shipment->sub_total,
            'AED '.$shipment->vat_amount,
            'AED '.$shipment->postal_charge,
            'AED '.$shipment->total,
            'AED '.$shipment->special_cod,
            'AED '.$shipment->collect_cod_amount,
            $shipment->cod_type,
        ];
    }


    public function headings(): array
    {
        return [
            'Inv ID',
            'Date',
            'User Type',
            'User Details',
            'Shipping Mode',
            'Special Shipment',
            'Shipment Details',
            'Ship From',
            'Ship To',
            'Shipment Price',
            'Insurance',
            'C.O.D',
            'Sub Total',
            'Vat',
            'Postal Charge',
            'Total',
            'Special C.O.D',
            'Collected C.O.D',
            'C.O.D Payment Type',
        ];
    }

}