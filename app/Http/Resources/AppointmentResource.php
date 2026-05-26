<?php

namespace App\Http\Resources;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(
        Request $request
    ): array {

        return [

            'id' => $this->id,

            'doctor' => [
                'id' => $this->doctor?->id,
                'name' => $this->doctor?->user?->name,
                'specialization' =>
                    $this->doctor?->specialization
            ],

            'patient' => [
                'id' => $this->patient?->id,
                'name' => $this->patient?->name,
                'email' => $this->patient?->email
            ],

            'appointment_date' =>
                $this->appointment_date,

            'appointment_time' =>
                $this->appointment_time,

            'status' =>
                $this->status,

            'remarks' =>
                $this->remarks
        ];
    }
}
