<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id')->nullable();  
            $table->string('category')->nullable();
            $table->string('reference_no')->nullable();
            $table->TEXT('description')->nullable();
            $table->string('weight')->nullable();  
            $table->string('length')->nullable();  
            $table->string('width')->nullable();  
            $table->string('height')->nullable();  
            $table->string('chargeable_weight')->nullable();  
            $table->string('status')->default('0'); 
            $table->string('sku_value')->nullable();
            $table->string('exception')->default('0'); 
            $table->string('exception_category')->nullable();
            $table->TEXT('exception_remark')->nullable();
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
        Schema::dropIfExists('shipment_packages');
    }
}
