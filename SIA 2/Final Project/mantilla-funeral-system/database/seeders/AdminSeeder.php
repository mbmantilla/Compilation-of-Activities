<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@mantilla.test'],
            [
                'name' => 'Mantilla Funeral Admin',
                'password' => 'password',
                'role' => 'admin',
                'phone' => '09123456789',
                'address' => 'Mantilla Funeral Office',
            ]
        );
    }
}
