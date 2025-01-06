<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Constants\Enum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $user = \App\Models\User::factory()->create([
            'name' => 'doctor',
            'email' => 'doctor@gmail.com',
            'username' => 'doctor',
            'specialty_id' => 1,
            'role' => Enum::DOCTOR,
            'password' => Hash::make('123456'),
            'verified_by_admin' => 1,
        ]);

        $specialties = [
            'Cardiology',       // أمراض القلب
            'Dermatology',      // الأمراض الجلدية
            'Neurology',        // طب الأعصاب
            'Pediatrics',       // طب الأطفال
            'Orthopedics',      // جراحة العظام
            'Psychiatry',       // الطب النفسي
            'Ophthalmology',    // طب العيون
            'Gynecology',       // طب النساء والتوليد
            'Radiology',        // الأشعة
            'General Surgery',  // الجراحة العامة
        ];
        foreach ($specialties as $specialty) {
            \App\Models\Specialty::query()->create([
                'name' => $specialty
            ]);
        }

    }
}
