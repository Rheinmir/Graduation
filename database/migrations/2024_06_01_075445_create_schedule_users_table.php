<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id')->comment('id người dùng');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('schedule_id')->comment('id lịch hẹn');
            $table->foreign('schedule_id')->references('id')->on('schedules');

            $table->tinyInteger('status')->nullable()->comment('Trạng thái đăng ký lịch hẹn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_users');
    }
};
