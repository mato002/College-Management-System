<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
            $table->decimal('score', 5, 2)->nullable(); // e.g. 75.50
            $table->string('grade', 8)->nullable();     // e.g. A, B+, C
            $table->string('semester', 32)->nullable();
            $table->foreignId('entered_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['enrollment_id', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
