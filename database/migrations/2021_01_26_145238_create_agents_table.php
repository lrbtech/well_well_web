<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('agent_id')->nullable();  
            $table->string('name')->nullable();  
            $table->string('email')->nullable();  
            $table->string('mobile')->nullable();  
            $table->string('password')->nullable();  
            $table->string('gender')->nullable(); 
            $table->string('dob')->nullable(); 
            $table->string('city_id')->nullable();  
            $table->string('area_ids')->nullable();  
            $table->string('driving_license')->nullable();  
            $table->string('driving_license_file')->nullable();  
            $table->string('emirates_id')->nullable();  
            $table->string('emirates_id_file')->nullable();  
            $table->string('vehicle_number')->nullable();  
            $table->string('vehicle_details')->nullable();  
            $table->string('firebase_key')->nullable(); 
            $table->string('pickup')->default('0');
            $table->string('delivery')->default('0');
            $table->string('revenue_exception')->default('0');
            $table->string('cash_report')->default('0');
            $table->string('hub')->default('0');
            $table->string('van_scan')->default('0');
            $table->string('total_payment')->default('0');  
            $table->string('settle_payment')->default('0');  
            $table->string('balance_payment')->default('0');  
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
        Schema::dropIfExists('agents');
    }
}
