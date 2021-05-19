<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempShipmentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_shipment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('temp_id')->nullable();  
            $table->string('sku_value')->nullable();  
            $table->string('category')->nullable();
            $table->TEXT('description')->nullable();
            $table->string('weight')->nullable();  
            $table->string('length')->nullable();  
            $table->string('width')->nullable();  
            $table->string('height')->nullable();  
            $table->string('chargeable_weight')->nullable();  
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
        Schema::dropIfExists('temp_shipment_packages');
    }
}
