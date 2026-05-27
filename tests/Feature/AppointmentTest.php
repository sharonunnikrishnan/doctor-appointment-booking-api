<?php

use App\Models\User;
use App\Models\Doctor;
use Laravel\Sanctum\Sanctum;

test('patient can create appointment', function () {

    $patient = User::factory()->create();

    Sanctum::actingAs($patient);

    $doctorUser = User::factory()->create();

    $doctor = Doctor::create([
        'user_id' => $doctorUser->id,
        'specialization' => 'Cardiology',
        'experience' => 10,
        'consultation_fee' => 1000
    ]);

    $response = $this->postJson(
        '/api/appointments',
        [
            'doctor_id' => $doctor->id,
            'appointment_date' => now()
                ->addDay()
                ->toDateString(),
            'appointment_time' => '10:00'
        ]
    );

    $response->assertCreated();

});
