<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_settlements', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->TEXT('shipment_ids')->nullable();
            $table->string('no_of_shipments')->nullable();
            $table->string('agent_id')->nullable();
            $table->string('receiver_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('mode')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('agent_settlements');
    }
}
