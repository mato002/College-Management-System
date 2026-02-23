<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timetable_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->string('day_of_week', 16); // Mon, Tue, etc. or 1-7
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room', 64)->nullable();
            $table->string('semester', 32)->nullable();
            $table->timestamps();

            $table->index(['unit_id', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timetable_slots');
    }
};
