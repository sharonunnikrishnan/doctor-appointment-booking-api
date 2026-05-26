<?php

namespace App\Listeners;

use App\Events\AppointmentBooked;
use App\Jobs\SendAppointmentConfirmationJob;
use Illuminate\Support\Facades\Log;

class SendAppointmentConfirmationListener
{
    public function handle(
        AppointmentBooked $event
    ): void
    {
        Log::info('Listener Executed');

        SendAppointmentConfirmationJob::dispatch(
            $event->appointment
        );

        Log::info('Job Dispatched');
    }
}
