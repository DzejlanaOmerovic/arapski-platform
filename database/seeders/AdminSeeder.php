<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Kreira admina samo ako ne postoji
        User::firstOrCreate(
            ['email' => 'admin@arapski.com'],
            [
                'name'     => 'Administrator',
                'username' => 'admin.001',
                'password' => Hash::make('Admin123!'),
                'role'     => 'admin',
                'status'   => 'approved',
            ]
        );
    }
}