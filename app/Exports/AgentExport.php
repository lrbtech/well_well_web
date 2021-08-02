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

class AgentExport implements FromCollection, ShouldAutoSize , WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($agent_id,$fdate,$tdate,$shipment_status)
    {
        $this->fdate = $fdate;
        $this->tdate = $tdate;
        $this->agent_id = $agent_id;
        $this->shipment_status = $shipment_status;
    }

    public function collection()
    {
        $i =DB::table('shipments');
        if ( $this->fdate != '1970-01-01' && $this->tdate != '1970-01-01' && $this->agent_id == 'agent' && $this->shipment_status == '20' )
        {
            $i->where([
                ['status',1],
                ['pickup_assign_date','<=',$this->tdate],
                ['pickup_assign_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',2],
                ['package_collect_date','<=',$this->tdate],
                ['package_collect_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',3],
                ['exception_assign_date','<=',$this->tdate],
                ['exception_assign_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',4],
                ['transit_in_date','<=',$this->tdate],
                ['transit_in_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',11],
                ['transit_in_date','<=',$this->tdate],
                ['transit_in_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',6],
                ['transit_out_date','<=',$this->tdate],
                ['transit_out_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',12],
                ['transit_out_date','<=',$this->tdate],
                ['transit_out_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',13],
                ['package_at_station_date','<=',$this->tdate],
                ['package_at_station_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',14],
                ['package_at_station_date','<=',$this->tdate],
                ['package_at_station_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',7],
                ['van_scan_date','<=',$this->tdate],
                ['van_scan_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',8],
                ['delivery_date','<=',$this->tdate],
                ['delivery_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',9],
                ['delivery_exception_assign_date','<=',$this->tdate],
                ['delivery_exception_assign_date','>=',$this->fdate],
            ]);
        }
        else if ( $this->fdate != '1970-01-01' && $this->tdate != '1970-01-01' && $this->agent_id == 'agent' && $this->shipment_status != '20' )
        {
            $i->where([
                ['status',$this->shipment_status],
                ['pickup_assign_date','<=',$this->tdate],
                ['pickup_assign_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['package_collect_date','<=',$this->tdate],
                ['package_collect_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['exception_assign_date','<=',$this->tdate],
                ['exception_assign_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['transit_in_date','<=',$this->tdate],
                ['transit_in_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['transit_in_date','<=',$this->tdate],
                ['transit_in_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['transit_out_date','<=',$this->tdate],
                ['transit_out_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['transit_out_date','<=',$this->tdate],
                ['transit_out_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['package_at_station_date','<=',$this->tdate],
                ['package_at_station_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['package_at_station_date','<=',$this->tdate],
                ['package_at_station_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['van_scan_date','<=',$this->tdate],
                ['van_scan_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['delivery_date','<=',$this->tdate],
                ['delivery_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['status',$this->shipment_status],
                ['delivery_exception_assign_date','<=',$this->tdate],
                ['delivery_exception_assign_date','>=',$this->fdate],
            ]);
        }
        else if ( $this->fdate != '1970-01-01' && $this->tdate != '1970-01-01' && $this->agent_id != 'agent' && $this->shipment_status == '20' )
        {
            $i->where([
                ['pickup_agent_id',$this->agent_id],
                ['status',1],
                ['pickup_assign_date','<=',$this->tdate],
                ['pickup_assign_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['package_collect_agent_id',$this->agent_id],
                ['status',2],
                ['package_collect_date','<=',$this->tdate],
                ['package_collect_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['pickup_exception_id',$this->agent_id],
                ['status',3],
                ['exception_assign_date','<=',$this->tdate],
                ['exception_assign_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['transit_in_id',$this->agent_id],
                ['status',4],
                ['transit_in_date','<=',$this->tdate],
                ['transit_in_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['transit_in_id1',$this->agent_id],
                ['status',11],
                ['transit_in_date','<=',$this->tdate],
                ['transit_in_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['transit_out_id',$this->agent_id],
                ['status',6],
                ['transit_out_date','<=',$this->tdate],
                ['transit_out_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['transit_out_id1',$this->agent_id],
                ['status',12],
                ['transit_out_date','<=',$this->tdate],
                ['transit_out_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['package_at_station_id',$this->agent_id],
                ['status',13],
                ['package_at_station_date','<=',$this->tdate],
                ['package_at_station_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['package_at_station_id1',$this->agent_id],
                ['status',14],
                ['package_at_station_date','<=',$this->tdate],
                ['package_at_station_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['van_scan_id',$this->agent_id],
                ['status',7],
                ['van_scan_date','<=',$this->tdate],
                ['van_scan_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['delivery_agent_id',$this->agent_id],
                ['status',8],
                ['delivery_date','<=',$this->tdate],
                ['delivery_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['delivery_exception_id',$this->agent_id],
                ['status',9],
                ['delivery_exception_assign_date','<=',$this->tdate],
                ['delivery_exception_assign_date','>=',$this->fdate],
            ]);
        }
        else if ( $this->fdate != '1970-01-01' && $this->tdate != '1970-01-01' && $this->agent_id != 'agent' && $this->shipment_status != '20' )
        {
            $i->where([
                ['pickup_agent_id',$this->agent_id],
                ['status',$this->shipment_status],
                ['pickup_assign_date','<=',$this->tdate],
                ['pickup_assign_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['package_collect_agent_id',$this->agent_id],
                ['status',$this->shipment_status],
                ['package_collect_date','<=',$this->tdate],
                ['package_collect_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['pickup_exception_id',$this->agent_id],
                ['status',$this->shipment_status],
                ['exception_assign_date','<=',$this->tdate],
                ['exception_assign_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['transit_in_id',$this->agent_id],
                ['status',$this->shipment_status],
                ['transit_in_date','<=',$this->tdate],
                ['transit_in_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['transit_in_id1',$this->agent_id],
                ['status',$this->shipment_status],
                ['transit_in_date','<=',$this->tdate],
                ['transit_in_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['transit_out_id',$this->agent_id],
                ['status',$this->shipment_status],
                ['transit_out_date','<=',$this->tdate],
                ['transit_out_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['transit_out_id1',$this->agent_id],
                ['status',$this->shipment_status],
                ['transit_out_date','<=',$this->tdate],
                ['transit_out_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['package_at_station_id',$this->agent_id],
                ['status',$this->shipment_status],
                ['package_at_station_date','<=',$this->tdate],
                ['package_at_station_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['package_at_station_id1',$this->agent_id],
                ['status',$this->shipment_status],
                ['package_at_station_date','<=',$this->tdate],
                ['package_at_station_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['van_scan_id',$this->agent_id],
                ['status',$this->shipment_status],
                ['van_scan_date','<=',$this->tdate],
                ['van_scan_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['delivery_agent_id',$this->agent_id],
                ['status',$this->shipment_status],
                ['delivery_date','<=',$this->tdate],
                ['delivery_date','>=',$this->fdate],
            ]);
            $i->orWhere([
                ['delivery_exception_id',$this->agent_id],
                ['status',$this->shipment_status],
                ['delivery_exception_assign_date','<=',$this->tdate],
                ['delivery_exception_assign_date','>=',$this->fdate],
            ]);
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

        $status='';
        if($shipment->status == 0){
            $status='Ready for Pickup';
        }
        elseif($shipment->status == 1){
            $agent = agent::find($shipment->pickup_agent_id);
            if(!empty($agent)){
                $status='Schedule for Pickup '.$agent->agent_id;
            }
            else{
                $status='Schedule for Pickup';
            }
        }
        elseif($shipment->status == 2){
            $agent = agent::find($shipment->pickup_agent_id);
            if(!empty($agent)){
                $status='Package Collected '.$agent->agent_id;
            }
            else{
                $status='Package Collected';
            }
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
            $agent = agent::find($shipment->transit_in_id);
            if(!empty($agent)){
                $status='
                Transit In '.$from_station->station.'
                Agent ID '.$agent->agent_id.''
               ;
            }
            else{
                $status='
                Transit In '.$from_station->station.''
               ;
            }
        }
        elseif($shipment->status == 5){
            $status='Assign Agent to Transit Out (Hub)';
        }
        elseif($shipment->status == 6){
            $to_station = station::find($shipment->to_station_id);
            $agent = agent::find($shipment->transit_out_id);
            if(!empty($agent)){
                $status='
                Transit Out '.$to_station->station.'
                Agent ID '.$agent->agent_id.''
               ;
            }
            else{
                $status='
                Transit Out '.$to_station->station.''
               ;
            }
        }
        elseif($shipment->status == 7){
            $agent = agent::find($shipment->delivery_agent_id);
            if(!empty($agent)){
                $status='
                In the Van for Delivery
                Agent ID '.$agent->agent_id.''
               ;
            }
            else{
                $status='
                In the Van for Delivery'
               ;
            }
        }
        elseif($shipment->status == 8){
            $agent = agent::find($shipment->delivery_agent_id);
            if(!empty($agent)){
                $status='Shipment delivered
                Agent ID '.$agent->agent_id;
            }
            else{
                $status='Shipment delivered';
               ;
            }
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
            ' . $shipment->cancel_remark . '
            ';
        }
        elseif($shipment->status == 11){
            $status='
            Transit In
            ';
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

        $pickup_assigned='';
        $pickup_assigned_date=date('d-m-Y',strtotime($shipment->pickup_assign_date)) .' '. date('h:i a',strtotime($shipment->pickup_assign_time));

        if($shipment->pickup_agent_id != ''){
            $agent = agent::find($shipment->pickup_agent_id);
            if(!empty($agent)){
            $pickup_assigned=$agent->agent_id .' '. $agent->name;
            }
        }

        $pickup_exception='';
        $pickup_exception_date=date('d-m-Y',strtotime($shipment->exception_assign_date)) .' '. date('h:i a',strtotime($shipment->exception_assign_time));

        if($shipment->pickup_exception_id != ''){
            $agent = agent::find($shipment->pickup_exception_id);
            if(!empty($agent)){
            $pickup_exception=$agent->agent_id .' '. $agent->name;
            }
        }

        $package_collect='';
        $package_collect_date=date('d-m-Y',strtotime($shipment->package_collect_date)) .' '. date('h:i a',strtotime($shipment->package_collect_time));

        if($shipment->package_collect_agent_id != ''){
            $agent = agent::find($shipment->package_collect_agent_id);
            if(!empty($agent)){
            $package_collect=$agent->agent_id .' '. $agent->name;
            }
        }

        $from_transit_in='';
        $from_transit_in_date=date('d-m-Y',strtotime($shipment->transit_in_date)) .' '. date('h:i a',strtotime($shipment->transit_in_time));

        if($shipment->transit_in_id != ''){
            $agent = agent::find($shipment->transit_in_id);
            if(!empty($agent)){
            $from_transit_in=$agent->agent_id .' '. $agent->name;
            }
        }

        $to_transit_in='';
        $to_transit_in_date=date('d-m-Y',strtotime($shipment->transit_in_date)) .' '. date('h:i a',strtotime($shipment->transit_in_time));

        if($shipment->transit_in_id1 != ''){
            $agent = agent::find($shipment->transit_in_id1);
            if(!empty($agent)){
            $to_transit_in=$agent->agent_id .' '. $agent->name;
            }
        }

        $from_transit_out='';
        $from_transit_out_date=date('d-m-Y',strtotime($shipment->transit_out_date)) .' '. date('h:i a',strtotime($shipment->transit_out_time));

        if($shipment->transit_out_id != ''){
            $agent = agent::find($shipment->transit_out_id);
            if(!empty($agent)){
            $from_transit_out=$agent->agent_id .' '. $agent->name;
            }
        }

        $to_transit_out='';
        $to_transit_out_date=date('d-m-Y',strtotime($shipment->transit_out_date)) .' '. date('h:i a',strtotime($shipment->transit_out_time));

        if($shipment->transit_out_id1 != ''){
            $agent = agent::find($shipment->transit_out_id1);
            if(!empty($agent)){
            $to_transit_out=$agent->agent_id .' '. $agent->name;
            }
        }

        $from_package_at_station='';
        $from_package_at_station_date=date('d-m-Y',strtotime($shipment->package_at_station_date)) .' '. date('h:i a',strtotime($shipment->package_at_station_time));

        if($shipment->package_at_station_id != ''){
            $agent = agent::find($shipment->package_at_station_id);
            if(!empty($agent)){
            $from_package_at_station=$agent->agent_id .' '. $agent->name;
            }
        }

        $to_package_at_station='';
        $to_package_at_station_date=date('d-m-Y',strtotime($shipment->package_at_station_date)) .' '. date('h:i a',strtotime($shipment->package_at_station_time));

        if($shipment->package_at_station_id1 != ''){
            $agent = agent::find($shipment->package_at_station_id1);
            if(!empty($agent)){
            $to_package_at_station=$agent->agent_id .' '. $agent->name;
            }
        }

        $van_scan='';
        $van_scan_date=date('d-m-Y',strtotime($shipment->van_scan_date)) .' '. date('h:i a',strtotime($shipment->van_scan_time));

        if($shipment->van_scan_id != ''){
            $agent = agent::find($shipment->van_scan_id);
            if(!empty($agent)){
            $van_scan=$agent->agent_id .' '. $agent->name;
            }
        }

        $delivery_exception='';
        $delivery_exception_date=date('d-m-Y',strtotime($shipment->delivery_exception_assign_date)) .' '. date('h:i a',strtotime($shipment->delivery_exception_assign_time));

        if($shipment->delivery_exception_id != ''){
            $agent = agent::find($shipment->delivery_exception_id);
            if(!empty($agent)){
            $delivery_exception=$agent->agent_id .' '. $agent->name;
            }
        }

        $delivery='';
        $delivery_date=date('d-m-Y',strtotime($shipment->delivery_date)) .' '. date('h:i a',strtotime($shipment->delivery_time));

        if($shipment->delivery_agent_id != ''){
            $agent = agent::find($shipment->delivery_agent_id);
            if(!empty($agent)){
            $delivery=$agent->agent_id .' '. $agent->name;
            }
        }

        $shipment_date='';
        if($shipment->status == 0){
            $shipment_date= date("d-m-Y",strtotime($shipment->date));
        }
        elseif($shipment->status == 1){
            $shipment_date= date("d-m-Y",strtotime($shipment->pickup_assign_date));
        }
        elseif($shipment->status == 2){
            $shipment_date= date("d-m-Y",strtotime($shipment->package_collect_date));
        }
        elseif($shipment->status == 3){
            $shipment_date= date("d-m-Y",strtotime($shipment->exception_assign_date));
        }
        elseif($shipment->status == 4){
            $shipment_date= date("d-m-Y",strtotime($shipment->transit_in_date));
        }
        elseif($shipment->status == 6){
            $shipment_date= date("d-m-Y",strtotime($shipment->transit_out_date));
        }
        elseif($shipment->status == 13){
            $shipment_date= date("d-m-Y",strtotime($shipment->package_at_station_date));
        }
        elseif($shipment->status == 11){
            $shipment_date= date("d-m-Y",strtotime($shipment->transit_in_date));
        }
        elseif($shipment->status == 12){
            $shipment_date= date("d-m-Y",strtotime($shipment->transit_out_date));
        }
        elseif($shipment->status == 14){
            $shipment_date= date("d-m-Y",strtotime($shipment->package_at_station_date));
        }
        elseif($shipment->status == 7){
            $shipment_date= date("d-m-Y",strtotime($shipment->van_scan_date));
        }
        elseif($shipment->status == 8){
            $shipment_date= date("d-m-Y",strtotime($shipment->delivery_date));
        }
        elseif($shipment->status == 9){
            $shipment_date= date("d-m-Y",strtotime($shipment->delivery_exception_assign_date));
        }
        elseif($shipment->status == 10){
            $shipment_date= date("d-m-Y",strtotime($shipment->cancel_request_date));
        }

        
        return [
            $shipment_package[0]->sku_value,
            $shipment->reference_no,
            $shipment_date,
            $user_type,
            $user_details,
            $shipment_mode,
            $special_service,
            $shipment_details,
            $ship_from,
            $ship_to,
            $to_address->contact_name,
            $to_address->contact_mobile,
            $to_address->address1.$to_address->address2.$to_address->address3,
            $pickup_assigned,
            $pickup_exception,
            $package_collect,
            $from_transit_in,
            $to_transit_in,
            $from_transit_out,
            $to_transit_out,
            $from_package_at_station,
            $to_package_at_station,
            $van_scan,
            $delivery_exception,
            $delivery,
            $shipment->total,
            $shipment->special_cod,
            $shipment->collect_cod_amount,
            $shipment->cod_type,
        ];
    }


    public function headings(): array
    {
        return [
            'Tracking ID',
            'Reference No',
            'Date',
            'User Type',
            'User Details',
            'Shipping Mode',
            'Special Shipment',
            'Shipment Details',
            'Ship From',
            'Ship To',
            'To Name',
            'To Mobile',
            'To Address',
            'Pickup Assigned',
            'Pickup Exception',
            'Package Collected',
            'From Transit In',
            'To Transit In',
            'From Transit Out',
            'To Transit Out',
            'From Package At Station',
            'To Package At Station',
            'Van for Delivery',
            'Delivery Exception',
            'Shipment Delivered',
            'Shipment Price',
            'Special C.O.D',
            'Collected C.O.D',
            'C.O.D Payment Type',
        ];
    }


}
