<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class DatabaseSeeder extends Seeder
{
    /**
     * Create the first user from ADMIN_EMAIL / ADMIN_PASSWORD. No defaults exist on purpose.
     */
    public function run(): void
    {
        $email = config('ascend.admin.email');
        $password = config('ascend.admin.password');

        if (! $email || ! $password) {
            $this->command?->warn('ADMIN_EMAIL and ADMIN_PASSWORD are not set. Skipping admin user.');

            return;
        }

        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => config('ascend.admin.name'),
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ],
        );
    }
}
