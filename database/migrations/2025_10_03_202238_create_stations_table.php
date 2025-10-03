<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('state')->nullable(); // استان
            $table->string('code')->unique(); // کد اختصاری یکتا
            $table->string('main_contact')->nullable(); // مسئول اصلی ایستگاه
            $table->decimal('latitude', 10, 6)->nullable(); // مختصات
            $table->decimal('longitude', 10, 6)->nullable();
            $table->string('reference_datum')->nullable(); // مبنای ارتفاعی
            $table->boolean('is_online')->default(true); // آنلاین یا غیرفعال
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
