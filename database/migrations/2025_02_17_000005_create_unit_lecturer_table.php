<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_lecturer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lecturer_id')->constrained()->cascadeOnDelete();
            $table->string('semester', 32)->nullable();
            $table->timestamps();

            $table->unique(['unit_id', 'lecturer_id', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_lecturer');
    }
};
