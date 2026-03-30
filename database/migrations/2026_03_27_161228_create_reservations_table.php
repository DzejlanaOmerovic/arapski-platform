<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null');
            $table->dateTime('datum');
            $table->integer('trajanje_minuta')->default(60);
            $table->enum('status', ['pending', 'confirmed', 'rejected', 'completed', 'cancelled'])->default('pending');
            $table->text('napomena')->nullable();
            $table->decimal('cena', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};