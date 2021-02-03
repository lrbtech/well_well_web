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
            $table->string('return_package_cost_enable')->nullable();
            $table->string('special_cod_enable')->nullable();
            $table->string('special_cod')->nullable();
            $table->string('return_package_cost')->nullable();
            $table->string('shipment_mode')->nullable();
            $table->string('no_of_packages')->nullable();  
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
            $table->string('status')->default('0'); 
            $table->string('barcode_shipment')->nullable();
            $table->string('barcode_shipment_image')->nullable();
            $table->string('pickup_agent_id')->nullable();
            $table->string('station_agent_id')->nullable();
            $table->string('delivery_agent_id')->nullable();
            $table->string('pickup_assign_date_time')->nullable();
            $table->string('package_collect_date_time')->nullable();
            $table->string('pickup_received_date_time')->nullable();
            $table->string('exception_category')->nullable();
            $table->TEXT('exception_remark')->nullable();
            $table->string('exception_assign_date_time')->nullable();
            $table->string('exception_solved_date_time')->nullable();
            $table->string('station_assign_date_time')->nullable();
            $table->string('station_received_date_time')->nullable();
            $table->string('delivery_assign_date_time')->nullable();
            $table->string('delivery_received_date_time')->nullable();
            $table->string('delivery_date_time')->nullable();
            $table->TEXT('delivery_notes')->nullable();
            $table->string('receiver_id_copy')->nullable();
            $table->TEXT('receiver_signature')->nullable();
            $table->string('pdf_print')->nullable();
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
