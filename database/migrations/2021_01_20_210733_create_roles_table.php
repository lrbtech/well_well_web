<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->nullable();
            $table->string('dashboard')->nullable();
            $table->string('all_customer')->nullable();
            $table->string('all_customer_edit')->nullable();
            $table->string('all_customer_delete')->nullable();
            $table->string('new_customer')->nullable();
            $table->string('new_customer_edit')->nullable();
            $table->string('new_customer_delete')->nullable();
            $table->string('sales_team')->nullable();
            $table->string('sales_team_edit')->nullable();
            $table->string('sales_team_delete')->nullable();
            $table->string('accounts_team')->nullable();
            $table->string('accounts_team_edit')->nullable();
            $table->string('accounts_team_delete')->nullable();
            $table->string('create_shipment')->nullable();
            $table->string('create_special_shipment')->nullable();
            $table->string('all_shipment')->nullable();
            $table->string('revenue_exception')->nullable();
            $table->string('cancel_shipment')->nullable();
            $table->string('shipment_hold')->nullable();
            $table->string('new_pickup_request')->nullable();
            $table->string('new_pickup_request_edit')->nullable();
            $table->string('guest_pickup_request')->nullable();
            $table->string('guest_pickup_request_edit')->nullable();
            $table->string('today_bulk_pickup_request')->nullable();
            $table->string('today_bulk_pickup_request_edit')->nullable();
            $table->string('future_bulk_pickup_request')->nullable();
            $table->string('future_bulk_pickup_request_edit')->nullable();
            $table->string('pickup_assigned')->nullable();
            $table->string('pickup_exception')->nullable();
            $table->string('pickup_exception_edit')->nullable();
            $table->string('package_collected')->nullable();
            $table->string('transit_in')->nullable();
            $table->string('transit_out')->nullable();
            $table->string('package_at_station')->nullable();
            $table->string('van_for_delivery')->nullable();
            $table->string('delivery_exception')->nullable();
            $table->string('shipment_delivered')->nullable();
            $table->string('today_delivery')->nullable();
            $table->string('future_delivery')->nullable();
            $table->string('couriers')->nullable();
            $table->string('couriers_create')->nullable();
            $table->string('couriers_edit')->nullable();
            $table->string('couriers_delete')->nullable();
            $table->string('employees')->nullable();
            $table->string('employees_create')->nullable();
            $table->string('employees_edit')->nullable();
            $table->string('employees_delete')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('vehicle_create')->nullable();
            $table->string('vehicle_edit')->nullable();
            $table->string('vehicle_delete')->nullable();
            $table->string('vehicle_group')->nullable();
            $table->string('vehicle_group_create')->nullable();
            $table->string('vehicle_group_edit')->nullable();
            $table->string('vehicle_group_delete')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_type_create')->nullable();
            $table->string('vehicle_type_edit')->nullable();
            $table->string('vehicle_type_delete')->nullable();
            $table->string('shipment_report')->nullable();
            $table->string('revenue_report')->nullable();
            $table->string('agent_report')->nullable();
            $table->string('generate_invoice')->nullable();
            $table->string('guest_generate_invoice')->nullable();
            $table->string('invoice_history')->nullable();
            $table->string('courier_team_cod_settlement_report')->nullable();
            $table->string('courier_team_guest_settlement_report')->nullable();
            $table->string('accounts_team_settlement_report')->nullable();
            $table->string('payments_out_report')->nullable();
            $table->string('country')->nullable();
            $table->string('country_create')->nullable();
            $table->string('country_edit')->nullable();
            $table->string('country_delete')->nullable();
            $table->string('package_category')->nullable();
            $table->string('package_category_create')->nullable();
            $table->string('package_category_edit')->nullable();
            $table->string('package_category_delete')->nullable();
            $table->string('exception_category')->nullable();
            $table->string('exception_category_create')->nullable();
            $table->string('exception_category_edit')->nullable();
            $table->string('exception_category_delete')->nullable();
            $table->string('complaint_request')->nullable();
            $table->string('complaint_request_create')->nullable();
            $table->string('complaint_request_edit')->nullable();
            $table->string('complaint_request_delete')->nullable();
            $table->string('push_notification')->nullable();
            $table->string('push_notification_create')->nullable();
            $table->string('push_notification_edit')->nullable();
            $table->string('push_notification_delete')->nullable();
            $table->string('station')->nullable();
            $table->string('station_create')->nullable();
            $table->string('station_edit')->nullable();
            $table->string('station_delete')->nullable();
            $table->string('financial_settings')->nullable();
            $table->string('common_price')->nullable();
            $table->string('terms_and_conditions')->nullable();
            $table->string('social_media_links')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('languages')->nullable();
            $table->string('shipment_logs')->nullable();
            $table->string('system_logs')->nullable();
            $table->string('roles')->nullable();
            $table->string('roles_create')->nullable();
            $table->string('roles_edit')->nullable();
            $table->string('roles_delete')->nullable();
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
        Schema::dropIfExists('roles');
    }
}
