<?php

namespace App\Services;

use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

class AppointmentService
{
    public function create(array $data): Appointment
    {
        return DB::transaction(function () use ($data) {

            $exists = Appointment::where('doctor_id', $data['doctor_id'])
                ->where('appointment_date', $data['appointment_date'])
                ->where('appointment_time', $data['appointment_time'])
                ->whereNotIn('status', ['cancelled'])
                ->exists();

            if ($exists) {
                throw new \Exception(
                    'Selected slot is already booked.'
                );
            }

            return Appointment::create($data);
        });
    }

    public function update(
        Appointment $appointment,
        array $data
    ): Appointment {

        $appointment->update($data);

        return $appointment;
    }

    public function delete(
        Appointment $appointment
    ): bool {

        return $appointment->delete();
    }
}
