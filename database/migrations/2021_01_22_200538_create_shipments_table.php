<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();  
            $table->string('date')->nullable();  
            $table->string('shipment_type')->nullable(); 
            $table->string('shipment_date')->nullable();  
            $table->string('shipment_from_time')->nullable();        
            $table->string('shipment_to_time')->nullable();           
            $table->string('drop_point')->nullable();  
            $table->string('sender_id')->nullable();  
            $table->string('receiver_id')->nullable();  
            $table->string('from_address')->nullable();  
            $table->string('to_address')->nullable();
            $table->string('from_station_id')->default('0'); 
            $table->string('to_station_id')->default('0'); 
            $table->string('notification_enable')->nullable();  
            $table->string('special_service')->nullable();  
            $table->TEXT('special_service_description')->nullable();  
            $table->string('special_cod_enable')->nullable();
            $table->string('special_cod')->nullable();
            $table->string('collect_cod_amount')->nullable();
            $table->string('cod_type')->nullable();
            $table->string('credit_verification_code')->nullable();
            $table->string('last_four_digit')->nullable();
            $table->string('return_package_cost')->nullable();
            $table->string('shipment_mode')->nullable();
            $table->string('no_of_packages')->nullable(); 
            $table->string('identical')->nullable(); 
            $table->string('reference_no')->nullable(); 
            $table->string('declared_value')->nullable();  
            $table->string('total_weight')->nullable();  
            $table->string('shipment_price')->nullable();
            $table->string('postal_charge_percentage')->nullable();
            $table->string('postal_charge')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('vat_percentage')->nullable();
            $table->string('vat_amount')->nullable();
            $table->string('insurance_percentage')->nullable();
            $table->string('insurance_amount')->nullable();
            $table->string('before_total')->nullable();
            $table->string('cod_amount')->nullable();
            $table->string('total')->nullable();
            $table->string('cancel_fees')->nullable();
            $table->string('status')->default('0'); 
            $table->string('invoice_status')->default('0'); 
            $table->string('hold_status')->default('0'); 
            $table->string('paid_status')->default('0'); 
            $table->string('paid_date')->nullable();

            $table->string('paid_agent_status')->default('0'); 
            $table->string('paid_agent_date')->nullable();

            $table->string('pickup_agent_id')->nullable();
            $table->string('pickup_assign_date')->nullable();
            $table->string('pickup_assign_time')->nullable();
            
            $table->string('package_collect_agent_id')->nullable();
            $table->string('package_collect_date')->nullable();
            $table->string('package_collect_time')->nullable();
            
            //$table->string('pickup_received_date')->nullable();
            //$table->string('pickup_received_time')->nullable();
            
            $table->string('pickup_exception_id')->nullable();
            $table->string('exception_category')->nullable();
            $table->TEXT('exception_remark')->nullable();
            $table->string('exception_assign_date')->nullable();
            $table->string('exception_assign_time')->nullable();
            
            $table->string('exception_solved_date')->nullable();
            $table->string('exception_solved_time')->nullable();
            
            //$table->string('station_assign_date')->nullable();
            //$table->string('station_assign_time')->nullable();

            //$table->string('station_agent_id')->nullable();
            //$table->string('station_received_date')->nullable();
            //$table->string('station_received_time')->nullable();
            
            $table->string('transit_in_id')->nullable();
            $table->string('transit_in_date')->nullable();
            $table->string('transit_in_time')->nullable();

            $table->string('transit_in_id1')->nullable();
            $table->string('transit_in_date1')->nullable();
            $table->string('transit_in_time1')->nullable();

            $table->string('revenue_exception_id')->nullable();
            $table->string('revenue_exception_date')->nullable();
            $table->string('revenue_exception_time')->nullable();

            $table->string('transit_out_id')->nullable();
            $table->string('transit_out_date')->nullable();
            $table->string('transit_out_time')->nullable();

            $table->string('transit_out_id1')->nullable();
            $table->string('transit_out_date1')->nullable();
            $table->string('transit_out_time1')->nullable();

            $table->string('package_at_station_id')->nullable();
            $table->string('package_at_station_date')->nullable();
            $table->string('package_at_station_time')->nullable();

            $table->string('package_at_station_id1')->nullable();
            $table->string('package_at_station_date1')->nullable();
            $table->string('package_at_station_time1')->nullable();

            $table->string('van_scan_id')->nullable();
            $table->string('van_scan_date')->nullable();
            $table->string('van_scan_time')->nullable();

            $table->string('delivery_agent_id')->nullable();
            //$table->string('delivery_assign_date')->nullable();
            //$table->string('delivery_assign_time')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('delivery_time')->nullable();
            $table->TEXT('delivery_notes')->nullable();

            $table->string('delivery_exception_id')->nullable();
            $table->string('delivery_exception_category')->nullable();
            $table->TEXT('delivery_exception_remark')->nullable();
            $table->string('delivery_exception_assign_date')->nullable();
            $table->string('delivery_exception_assign_time')->nullable();

            $table->string('delivery_exception_solved_date')->nullable();
            $table->string('delivery_exception_solved_time')->nullable();

            $table->string('delivery_reschedule')->default('0');
            $table->string('delivery_reschedule_date')->nullable();

            $table->string('receiver_id_copy')->nullable();
            $table->TEXT('cancel_remark')->nullable();
            $table->string('cancel_pay')->default('0');
            $table->string('cancel_request_date')->nullable();
            $table->string('cancel_request_time')->nullable();
            $table->string('canceled_date')->nullable();
            $table->string('canceled_time')->nullable();
            $table->TEXT('receiver_signature')->nullable();
            $table->string('receiver_signature_name')->nullable();
            $table->string('signature_person_name')->nullable();
            $table->TEXT('delivery_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
