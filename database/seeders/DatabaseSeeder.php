<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user directly (no Faker needed for production)
        User::firstOrCreate(
            ['email' => 'admin@ascend-ai.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@ascend-ai.com',
                'password' => Hash::make('ChangeThisPassword123!'),
                'email_verified_at' => now(),
            ]
        );
    }
}
