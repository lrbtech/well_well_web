<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_notes', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id')->nullable();  
            $table->string('agent_id')->nullable();  
            $table->string('admin_id')->nullable();  
            $table->TEXT('notes')->nullable();  
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
        Schema::dropIfExists('shipment_notes');
    }
}
