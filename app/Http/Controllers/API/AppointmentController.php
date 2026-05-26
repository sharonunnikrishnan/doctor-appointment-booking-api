<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Services\AppointmentService;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;

use App\Http\Resources\AppointmentResource;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{

    protected AppointmentService $service;

    public function __construct(
        AppointmentService $service
    )
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with([
            'doctor.user',
            'patient'
        ])
        ->latest()
        ->paginate(10);

        return AppointmentResource::collection(
            $appointments
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreAppointmentRequest $request
    )
    {
        try {

            $appointment =
                $this->service->create([

                    'doctor_id' =>
                        $request->doctor_id,

                    'patient_id' =>
                        auth()->id(),

                    'appointment_date' =>
                        $request->appointment_date,

                    'appointment_time' =>
                        $request->appointment_time,

                    'status' => 'pending'
                ]);

            return response()->json([
                'message' =>
                    'Appointment booked successfully',

                'data' =>
                    new AppointmentResource(
                        $appointment
                    )
            ],201);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ],422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Appointment $appointment
    )
    {

        Gate::authorize(
            'view',
            $appointment
        );

        $appointment->load([
            'doctor.user',
            'patient'
        ]);

        return new AppointmentResource(
            $appointment
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateAppointmentRequest $request,
        Appointment $appointment
    )
    {
         Gate::authorize(
            'update',
            $appointment
        );

        $appointment =
            $this->service->update(
                $appointment,
                $request->validated()
            );

        return response()->json([
            'message' =>
                'Appointment updated',

            'data' =>
                new AppointmentResource(
                    $appointment
                )
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Appointment $appointment
    )
    {
        Gate::authorize(
            'delete',
            $appointment
        );

        $this->service
            ->delete($appointment);

        return response()->json([
            'message' =>
                'Appointment deleted'
        ]);
    }
}
