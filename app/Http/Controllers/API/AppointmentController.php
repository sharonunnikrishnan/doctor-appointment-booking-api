<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreAppointmentRequest $request,
        AppointmentService $service
    )
    {
        $appointment =
            $service->create([

            'doctor_id'=>$request->doctor_id,

            'patient_id'=>auth()->id(),

            'appointment_date'=>$request->appointment_date,

            'appointment_time'=>$request->appointment_time,
        ]);

        return response()->json([
            'message'=>'Appointment created',
            'data'=>$appointment
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
