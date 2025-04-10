<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nama Umum

            // === ✈️ PENERBANGAN ===
            $table->string('departure_airport')->nullable();
            $table->string('arrival_airport')->nullable();
            $table->date('departure_date')->nullable();
            $table->time('departure_time')->nullable();
            $table->date('arrival_date')->nullable();
            $table->time('arrival_time')->nullable();

            // === 🏨 HOTEL ===
            $table->string('room_type')->nullable();
            $table->string('location')->nullable();

            // === 📚 KURSUS ===
            $table->string('materi')->nullable();
            $table->string('pengajar')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('jam_kursus')->nullable();

            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
