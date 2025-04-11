<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a dummy user
        User::create([
            'name' => 'Olivia Wilson',
            'email' => 'olivia@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}