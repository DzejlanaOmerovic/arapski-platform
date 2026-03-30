<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->string('naziv');
            $table->text('opis')->nullable();
            $table->enum('nivo', ['pocetni', 'srednji', 'napredni']);
            $table->decimal('cena', 8, 2)->nullable();
            $table->enum('tip', ['grupni', 'individualni'])->default('individualni');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('slika')->nullable();
            $table->integer('max_students')->nullable();
            $table->integer('trajanje_minuta')->default(60);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};