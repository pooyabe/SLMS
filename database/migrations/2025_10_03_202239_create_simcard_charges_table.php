<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simcard_charges', function (Blueprint $table) {
            $table->id();

            $table->foreignId('station_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->date('charge_date');
            $table->integer('charge_amount'); // مثلا به تومان

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simcard_charges');
    }
};
