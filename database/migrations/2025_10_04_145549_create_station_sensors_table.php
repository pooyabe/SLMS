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

            $table->float('min_val')->nullable();
            $table->float('max_val')->nullable();
            $table->float('min_val_height')->nullable();
            $table->float('max_val_height')->nullable();

            $table->enum('sensor_data_transfer_type', ['V', 'A'])->nullable(); // ولتاژ یا جریان
            $table->float('offset')->nullable();
            $table->float('gain')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('station_sensors');
    }
};
