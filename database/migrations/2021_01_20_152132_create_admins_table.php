<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('role_id')->default('0');
            $table->string('station_id')->default('0');
            $table->string('status')->default('0');
            $table->string('lang')->default('english');
            $table->string('languages')->nullable();
            $table->string('common_price')->nullable();
            $table->string('financial_settings')->nullable();
            $table->string('user_report')->nullable();
            $table->string('agent_report')->nullable();
            $table->string('revenue_report')->nullable();
            $table->string('shipment_report')->nullable();
            $table->string('all_shipment')->nullable();
            $table->string('cancel_request')->nullable();
            $table->string('shipment_delivered')->nullable();
            $table->string('delivery_exception')->nullable();
            $table->string('ready_for_delivery')->nullable();
            $table->string('transit_out')->nullable();
            $table->string('transit_in')->nullable();
            $table->string('package_collected')->nullable();
            $table->string('pickup_exception')->nullable();
            $table->string('schedule_for_pickup')->nullable();
            $table->string('new_shipment_request')->nullable();
            $table->string('new_shipment')->nullable();
            $table->string('view_customer')->nullable();
            $table->string('new_customer')->nullable();
            $table->string('sales_team')->nullable();
            $table->string('accounts_team')->nullable();
            $table->string('today_pickup_request')->nullable();
            $table->string('future_pickup_request')->nullable();
            $table->string('dashboard')->nullable();
            $table->string('station')->nullable();
            $table->string('station_create')->nullable();
            $table->string('station_edit')->nullable();
            $table->string('station_delete')->nullable();
            $table->string('exception_category')->nullable();
            $table->string('exception_category_create')->nullable();
            $table->string('exception_category_edit')->nullable();
            $table->string('exception_category_delete')->nullable();
            $table->string('package_category')->nullable();
            $table->string('package_category_create')->nullable();
            $table->string('package_category_edit')->nullable();
            $table->string('package_category_delete')->nullable();
            $table->string('country')->nullable();
            $table->string('country_create')->nullable();
            $table->string('country_edit')->nullable();
            $table->string('country_delete')->nullable();
            $table->string('city')->nullable();
            $table->string('city_create')->nullable();
            $table->string('city_edit')->nullable();
            $table->string('city_delete')->nullable();
            $table->string('area')->nullable();
            $table->string('area_create')->nullable();
            $table->string('area_edit')->nullable();
            $table->string('area_delete')->nullable();
            $table->string('agent')->nullable();
            $table->string('courier_create')->nullable();
            $table->string('courier_edit')->nullable();
            $table->string('courier_delete')->nullable();
            $table->string('employee')->nullable();
            $table->string('employee_create')->nullable();
            $table->string('employee_edit')->nullable();
            $table->string('employee_delete')->nullable();
            $table->string('system_logs')->nullable();
            $table->string('revenue_exception')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
