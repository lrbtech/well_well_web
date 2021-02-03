<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddRateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_rate_items', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('weight_from')->nullable();
            $table->string('weight_to')->nullable();
            $table->string('price')->nullable();
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
        Schema::dropIfExists('add_rate_items');
    }
}
