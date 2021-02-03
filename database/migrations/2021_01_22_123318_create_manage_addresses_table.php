<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();  
            $table->string('from_to')->nullable();  
            $table->string('address_type')->nullable();
            $table->string('contact_name')->nullable();  
            $table->string('contact_mobile')->nullable();  
            $table->string('contact_landline')->nullable();  
            $table->TEXT('address1')->nullable();  
            $table->TEXT('address2')->nullable();  
            $table->TEXT('address3')->nullable();  
            $table->string('area_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('country_id')->nullable(); 
            $table->string('latitude')->nullable();  
            $table->string('longitude')->nullable();  
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
        Schema::dropIfExists('manage_addresses');
    }
}
