<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('station_sensors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('station_id')->constrained()->onDelete('cascade');
            $table->foreignId('sensor_id')->constrained()->onDelete('cascade');

            $table->integer('min_val')->nullable();
            $table->integer('max_val')->nullable();
            $table->integer('min_val_height')->nullable();
            $table->integer('max_val_height')->nullable();

            $table->enum('sensor_data_transfer_type', ['V', 'A'])->nullable(); // ولتاژ یا جریان
            $table->integer('offset')->nullable();
            $table->tinyInteger('gain')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('station_sensors');
    }
};
