<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Mail\Mailable;

class AppointmentConfirmationMail extends Mailable
{
    public Appointment $appointment;

    public function __construct(
        Appointment $appointment
    )
    {
        $this->appointment = $appointment;
    }

    public function build()
    {
        return $this->subject(
                'Appointment Confirmation'
            )
            ->view(
                'emails.appointment-confirmation'
            );
    }
}
