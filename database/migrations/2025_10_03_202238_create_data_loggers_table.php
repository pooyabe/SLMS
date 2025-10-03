<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_loggers', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable(); // برند دیتالاگر
            $table->string('model')->nullable(); // مدل دیتالاگر
            $table->string('ip')->nullable(); // IP درصورت وجود
            $table->string('port')->nullable(); // پورت ارتباطی
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_loggers');
    }
};
