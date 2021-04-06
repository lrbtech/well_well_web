<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settlements', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->TEXT('shipment_ids')->nullable();
            $table->string('no_of_shipments')->nullable();
            $table->string('user_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('user_settlements');
    }
}
