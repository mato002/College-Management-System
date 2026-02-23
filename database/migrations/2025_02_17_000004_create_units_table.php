<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('semester', 32)->nullable(); // e.g. semester_1, semester_2
            $table->unsignedInteger('capacity')->default(0); // 0 = unlimited
            $table->unsignedTinyInteger('credits')->default(3);
            $table->string('status', 32)->default('active'); // active, archived
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
