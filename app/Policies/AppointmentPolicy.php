<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;

class AppointmentPolicy
{
    /**
     * Admin can do everything
     */
    public function before(
        User $user,
        string $ability
    )
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    /**
     * View appointment
     */
    public function view(
        User $user,
        Appointment $appointment
    ): bool {

        return
            $user->id === $appointment->patient_id ||

            $appointment->doctor &&
            $appointment->doctor->user_id === $user->id;
    }

    /**
     * Update appointment
     */
    public function update(
        User $user,
        Appointment $appointment
    ): bool {

        if ($user->role === 'patient') {

            return
                $user->id ===
                $appointment->patient_id;
        }

        if ($user->role === 'doctor') {

            return
                $appointment->doctor &&
                $appointment->doctor->user_id ===
                $user->id;
        }

        return false;
    }

    /**
     * Delete appointment
     */
    public function delete(
        User $user,
        Appointment $appointment
    ): bool {

        return
            $user->id ===
            $appointment->patient_id;
    }
}
