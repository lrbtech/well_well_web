<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_pays', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->string('date')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_description')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('invoice_pays');
    }
}
