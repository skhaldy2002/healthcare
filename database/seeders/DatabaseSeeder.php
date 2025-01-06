<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Constants\Enum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SettingsSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(PatientSeeder::class);

    }
}
