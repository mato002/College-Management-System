<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('reg_no')->unique();
            $table->string('phone', 32)->nullable();
            $table->string('programme')->nullable();
            $table->unsignedTinyInteger('year_of_study')->default(1);
            $table->string('status', 32)->default('active'); // active, suspended, graduated
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
