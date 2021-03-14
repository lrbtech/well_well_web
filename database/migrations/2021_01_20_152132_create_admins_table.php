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
            $table->string('total_guest')->default('0');
            $table->string('paid_guest')->default('0');
            $table->string('total_cod')->default('0');
            $table->string('paid_cod')->default('0');
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
