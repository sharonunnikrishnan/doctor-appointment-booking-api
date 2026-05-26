<?php

namespace App\Jobs;

use App\Mail\AppointmentConfirmationMail;
use App\Models\Appointment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendAppointmentConfirmationJob
implements ShouldQueue
{
    use Queueable;

    public Appointment $appointment;

    public function __construct(
        Appointment $appointment
    )
    {
        $this->appointment = $appointment;
    }

    public function handle(): void
    {
        Log::info(
            'Job Executed'
        );

        Mail::to(
            $this->appointment
                ->patient
                ->email
        )->send(
            new AppointmentConfirmationMail(
                $this->appointment
            )
        );
    }
}
