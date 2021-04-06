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

class LocationExport implements FromCollection, ShouldAutoSize , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct()
    {
    }

    public function collection()
    {
        $i =DB::table('cities as city');
        $i->where('city.parent_id',0);
        $i->join('cities as area', 'area.parent_id', '=', 'city.id');
        $i->select([ DB::raw("city.city as city_name") , DB::raw("area.city as area_name") ]);
        return $area = $i->get();
        //return booking::query()->whereYear('created_at', $this->fdate);
    }

    public function map($area): array
    {        
        return [
            $area->city_name,
            $area->area_name,
        ];
    }


    public function headings(): array
    {
        return [
            'City Name',
            'Area Name',
        ];
    }


}

