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
        Schema::create('iot_devices', function (Blueprint $table) {
            $table->id()->comment('Primary Key');
            $table->string('uuid', 45)->unique()->comment('รหัสประจำตัวอุปกรณ์ (Unique)');
            $table->foreignId('farm_id')->constrained('farms')->comment('FK: ชี้ไปที่ farms(id)');
            $table->text('description')->nullable()->comment('อธิบายจุดที่ติดตั้งอุปกรณ์');
            $table->boolean('status')->default(true)->comment('0=ปิด, 1=เปิด');
            $table->string('unit', 50)->nullable()->comment('หน่วยนับหลักของเครื่อง');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iot_devices');
    }
};
