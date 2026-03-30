<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->id();
            $table->string('kljuc')->unique();
            $table->text('vrednost')->nullable();
            $table->string('opis')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_settings');
    }
};