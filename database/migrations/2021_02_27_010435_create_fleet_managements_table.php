<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_managements', function (Blueprint $table) {
            $table->id();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('model_year')->nullable();
            $table->string('color')->nullable();
            $table->string('vin')->nullable();
            $table->string('engine')->nullable();
            $table->string('type_vehicle')->nullable();
            $table->string('department')->nullable();
            $table->string('group')->nullable();
            $table->string('plate_no')->nullable();
            $table->string('type')->nullable();
            $table->string('expirataion')->nullable();
            $table->string('odometer')->nullable();
            $table->string('odometer_date')->nullable();
            $table->string('insurance_no')->nullable();
            $table->string('insurance_expire')->nullable();
            $table->string('oil_change_date')->nullable();
            $table->string('service_date')->nullable();
            $table->string('agent_id')->nullable();
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
        Schema::dropIfExists('fleet_managements');
    }
}
