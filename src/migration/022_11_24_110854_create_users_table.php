<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('otp_code')->nullable();
            $table->dateTime('otp_send_time')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('device_type')->nullable(); //for example check request came from web or mobile
            $table->string('device_token')->nullable();
            $table->tinyInteger('is_verify')->default(0);
            $table->dateTime('otp_send_time')->nullable();
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
};