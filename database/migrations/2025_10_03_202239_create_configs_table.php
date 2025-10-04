<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('station_id')->constrained()->onDelete('cascade');
            $table->foreignId('datalogger_id')->constrained('data_loggers')->onDelete('cascade');

            $table->string('time_zone')->nullable();
            $table->integer('sample_rate')->nullable(); // دقیقه

            $table->enum('connection_type', [
                'FTP',
                'HTTP',
                'SMS',
                'OFFLINE_SD'
            ])->default('FTP');

            $table->string('server_folder_name')->nullable();

            $table->string('simcard_provider')->nullable();
            $table->string('phone_number')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
