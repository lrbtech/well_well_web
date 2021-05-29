<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_shipments', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();  
            $table->string('shipment_type')->nullable(); 
            // $table->string('shipment_date')->nullable();  
            // $table->string('shipment_from_time')->nullable();        
            // $table->string('shipment_to_time')->nullable();           
            $table->string('drop_point')->nullable();  
            $table->string('sender_id')->nullable();  
            $table->string('receiver_id')->nullable();  
            $table->string('from_address')->nullable();  
            $table->string('to_address')->nullable();
            $table->string('from_station_id')->default('0'); 
            $table->string('to_station_id')->default('0'); 
            $table->TEXT('shipment_notes')->nullable();
            $table->string('special_service')->nullable();  
            $table->TEXT('special_service_description')->nullable();  
            $table->string('special_cod_enable')->nullable();
            $table->string('special_cod')->nullable();
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
            $table->string('status')->default('0'); 
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
        Schema::dropIfExists('temp_shipments');
    }
}
