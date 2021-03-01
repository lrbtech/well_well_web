<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_users', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('name')->nullable();  
            $table->string('mobile')->nullable();  
            $table->string('landline')->nullable();  
            $table->TEXT('address')->nullable();  
            $table->string('area_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('country_id')->nullable(); 
            $table->string('latitude')->nullable();  
            $table->string('longitude')->nullable();
            $table->string('shipment_id')->nullable();  
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
        Schema::dropIfExists('guest_users');
    }
}
