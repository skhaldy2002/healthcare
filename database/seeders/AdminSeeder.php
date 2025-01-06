<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Constants\Enum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'role' => Enum::ADMIN,
            'password' => Hash::make('123456'),
            'verified_by_admin' => 1
        ]);


    }
}
