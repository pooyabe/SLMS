<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nrp_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('station_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->json('pictures')->nullable(); // مسیر عکس‌ها
            $table->json('fields')->nullable();   // فیلدهای فرم
            $table->json('leveling')->nullable(); // ترازیابی

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nrp_reports');
    }
};
