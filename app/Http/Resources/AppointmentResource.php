<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,

            'doctor'=>$this->doctor->user->name,

            'date'=>$this->appointment_date,

            'time'=>$this->appointment_time,

            'status'=>$this->status
        ];

        return AppointmentResource::collection(
            Appointment::latest()->get()
        );
    }
}
