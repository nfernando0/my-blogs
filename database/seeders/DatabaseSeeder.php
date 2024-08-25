<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'phone' => '081234567890',
            'is_admin' => true,
            'address' => 'Jalan Pahlawan No. 1',
            'password' => Hash::make('password'),
        ]);
    }
}
