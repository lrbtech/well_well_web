<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('user_type')->nullable();    
            $table->string('first_name')->nullable();   
            $table->string('last_name')->nullable(); 
            $table->string('business_name')->nullable(); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('website')->nullable();
            $table->string('mobile')->nullable(); 
            $table->string('mobile_verify')->default('0');       
            $table->string('landline')->nullable();  
            $table->string('address_id')->nullable();  
            $table->string('emirates_id')->nullable();  
            $table->string('trade_license')->nullable();  
            $table->string('vat_certificate_no')->nullable(); 
            $table->string('emirates_id_file')->nullable();  
            $table->string('vat_certificate_file')->nullable();           
            $table->string('trade_license_file')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->TEXT('verify_remark')->nullable();  
            $table->TEXT('signature_data')->nullable();  
            $table->TEXT('description')->nullable(); 
            $table->string('verify_date_time')->nullable();
            $table->string('status')->default('0');      
            $table->string('registration_user_id')->nullable();
            $table->string('registration_date_time')->nullable();
            $table->string('sales_user_id')->nullable();
            $table->string('sales_date_time')->nullable();
            $table->string('accounts_user_id')->nullable();  
            $table->string('accounts_date_time')->nullable();
            $table->string('lang')->default('english');
            $table->string('total')->default('0');
            $table->string('paid')->default('0');
            $table->string('balance')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
