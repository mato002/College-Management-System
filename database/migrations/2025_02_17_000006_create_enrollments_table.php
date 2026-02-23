<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->string('semester', 32)->nullable();
            $table->string('status', 32)->default('enrolled'); // enrolled, dropped, completed
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'unit_id', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
