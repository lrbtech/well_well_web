<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('sender_id')->nullable();
            $table->string('account_id')->nullable();
            $table->string('user_type')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->TEXT('address1')->nullable();
            $table->TEXT('address2')->nullable();
            $table->TEXT('address3')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('no_of_shipments')->nullable();
            $table->string('no_of_packages')->nullable();
            $table->TEXT('shipment_ids')->nullable();
            $table->string('cod_amount')->nullable();
            $table->string('total')->nullable();
            $table->string('paid')->nullable();
            $table->string('balance')->nullable();
            $table->string('payment_type')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
