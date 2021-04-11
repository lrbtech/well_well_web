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

class UserSettlementExport implements FromCollection, ShouldAutoSize , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($user_id,$fdate,$tdate)
    {
        $this->fdate = $fdate;
        $this->tdate = $tdate;
        $this->user_id = $user_id;
    }

    public function collection()
    {
        if ( $this->user_id != 'user'){
            $i =DB::table('user_settlements as s');
            if ( $this->fdate != '1' && $this->tdate != '1' )
            {
                $i->whereBetween('s.date', [$this->fdate, $this->tdate]);
            }
            if ( $this->user_id != 'user' )
            {
                $i->where('s.user_id', $this->user_id);
            }
            $shipment = $i->get();
        }
        else{
            $shipment = array();
        }

        return $shipment;
    }

    public function map($shipment): array
    {

        $user_details='';
        if($shipment->user_id == '0'){
            $address = manage_address::find($shipment->from_address);
            $user_details=$address->contact_name . $address->contact_mobile;
        }
        else{
            $user_details=$user->name . $user->mobile . $user->email;
        }
        
        $admin=admin::find($shipment->admin_id);
        return [
            date('d-m-Y',strtotime($row->date)),
            $user_details,
            $shipment->no_of_shipments,
            $shipment->amount,
            $admin->name,
        ];
    }


    public function headings(): array
    {
        return [
            'Date',
            'User Details',
            'No of Shipments',
            'Amount',
            'Admin',
        ];
    }

}
