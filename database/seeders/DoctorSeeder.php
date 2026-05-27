<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Dr John',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'role' => 'doctor'
        ]);

        Doctor::create([
            'user_id' => $user->id,
            'specialization' => 'Cardiology',
            'experience' => 10,
            'consultation_fee' => 1000
        ]);
    }
}
