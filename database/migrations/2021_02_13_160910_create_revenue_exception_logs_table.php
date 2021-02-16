<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueExceptionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_exception_logs', function (Blueprint $table) {
            $table->id();
            $table->string('package_id')->nullable();  
            $table->string('shipment_id')->nullable();  
            $table->string('old_weight')->nullable();  
            $table->string('old_length')->nullable();  
            $table->string('old_width')->nullable();  
            $table->string('old_height')->nullable();  
            $table->string('old_chargeable_weight')->nullable(); 
            $table->string('weight')->nullable();  
            $table->string('length')->nullable();  
            $table->string('width')->nullable();  
            $table->string('height')->nullable();  
            $table->string('chargeable_weight')->nullable();  
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
        Schema::dropIfExists('revenue_exception_logs');
    }
}
