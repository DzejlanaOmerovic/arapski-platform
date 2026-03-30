<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('about')->nullable();
            $table->string('arabic_level')->nullable();
            $table->decimal('price_per_hour', 8, 2)->nullable();
            $table->string('teaching_style')->nullable();
            $table->json('availability')->nullable();
            $table->json('languages')->nullable();
            $table->boolean('offers_group')->default(false);
            $table->boolean('offers_individual')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->decimal('discount', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_profiles');
    }
};