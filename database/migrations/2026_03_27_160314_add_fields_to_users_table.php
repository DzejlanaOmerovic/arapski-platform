<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->enum('role', ['admin', 'student', 'teacher'])->default('student')->after('username');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('role');
            $table->string('phone')->nullable()->after('status');
            $table->string('location')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('location');
            $table->string('profile_photo')->nullable()->after('bio');
            $table->integer('warning_count')->default(0)->after('profile_photo');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username', 'role', 'status', 'phone', 
                'location', 'bio', 'profile_photo', 'warning_count'
            ]);
        });
    }
};