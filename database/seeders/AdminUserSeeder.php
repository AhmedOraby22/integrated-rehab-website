<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $username = env('ADMIN_USERNAME', 'admin');
        $password = env('ADMIN_PASSWORD', 'Admin@123');
        $email = env('ADMIN_EMAIL', 'admin@integratedrehabandphysicaltherapy.com');

        User::updateOrCreate(
            ['username' => $username],
            [
                'name' => 'Site Administrator',
                'email' => $email,
                'password' => $password,
                'is_admin' => true,
            ]
        );
    }
}
