<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id')->nullable();  
            $table->string('admin_id')->nullable();
            $table->string('agent_id')->nullable();
            $table->string('remark')->nullable();  
            $table->string('shipment_status')->default('0');
            $table->string('date')->nullable();
            $table->string('time')->nullable();
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
        Schema::dropIfExists('shipment_logs');
    }
}
