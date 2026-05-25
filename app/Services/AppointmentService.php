<?php

use App\Models\Appointment;

class AppointmentService
{
    public function create(array $data)
    {
        return Appointment::create($data);
    }
}
