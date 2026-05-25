<?php

namespace App\Services;

use App\Models\Doctor;

class DoctorService
{
    public function create(array $data): Doctor
    {
        return Doctor::create($data);
    }

    public function update(Doctor $doctor, array $data): Doctor
    {
        $doctor->update($data);

        return $doctor;
    }

    public function delete(Doctor $doctor): bool
    {
        return $doctor->delete();
    }
}
