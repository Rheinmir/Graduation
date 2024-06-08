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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->comment('Tiêu đề lịch hẹn');
            $table->date('schedule_date')->nullable()->comment('ngày lịch hẹn');
            $table->text('contents')->nullable()->comment('Nội dung lịch hẹn');

            $table->tinyInteger('status')->nullable()->comment('Trạng thái lịch hẹn');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
