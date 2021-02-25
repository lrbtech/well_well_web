<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_rates', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('insurance_enable')->nullable();
            $table->string('insurance_percentage')->nullable();
            $table->string('cod_enable')->nullable();
            $table->string('cod_price')->nullable();
            $table->string('vat_enable')->nullable();
            $table->string('vat_percentage')->nullable();
            $table->string('postal_charge_enable')->nullable();
            $table->string('postal_charge_percentage')->nullable();
            $table->string('before_5_kg_price')->nullable();
            $table->string('above_5_kg_price')->nullable();
            $table->string('service_area_0_to_5_kg_price')->nullable();
            $table->string('service_area_5_to_10_kg_price')->nullable();
            $table->string('service_area_10_to_15_kg_price')->nullable();
            $table->string('service_area_15_to_20_kg_price')->nullable();
            $table->string('service_area_20_to_1000_kg_price')->nullable();
            $table->string('same_day_delivery_0_to_5_kg_price')->nullable();
            $table->string('same_day_delivery_5_to_10_kg_price')->nullable();
            $table->string('same_day_delivery_10_to_15_kg_price')->nullable();
            $table->string('same_day_delivery_15_to_20_kg_price')->nullable();
            $table->string('same_day_delivery_20_to_1000_kg_price')->nullable();
            $table->string('special_service_0_to_5_kg_price')->nullable();
            $table->string('special_service_5_to_10_kg_price')->nullable();
            $table->string('special_service_10_to_15_kg_price')->nullable();
            $table->string('special_service_15_to_20_kg_price')->nullable();
            $table->string('special_service_20_to_1000_kg_price')->nullable();
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
        Schema::dropIfExists('add_rates');
    }
}
