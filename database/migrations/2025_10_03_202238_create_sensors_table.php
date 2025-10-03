<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // نوع سنسور (فشاری، راداری، ...)
            $table->string('model')->nullable(); // مدل یا برند سنسور
            $table->integer('min_height')->nullable(); // کمینه ارتفاع ثبت
            $table->integer('max_height')->nullable(); // بیشینه ارتفاع ثبت
            $table->string('color')->nullable(); // رنگ نمودار
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
