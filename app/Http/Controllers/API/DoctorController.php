<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Services\DoctorService;

class DoctorController extends Controller
{
    protected DoctorService $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('user')
                        ->latest()
                        ->paginate(10);

        return DoctorResource::collection(
            $doctors
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreDoctorRequest $request
    )
    {

        $doctor = $this->doctorService->create([

            'user_id' => auth()->id(),

            'specialization' =>
                $request->specialization,

            'experience' =>
                $request->experience,

            'consultation_fee' =>
                $request->consultation_fee
        ]);

        return $this->success(
            new DoctorResource($doctor),
            'Doctor created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $doctor->load('user');

        return new DoctorResource(
            $doctor
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
    UpdateDoctorRequest $request,
        Doctor $doctor
    )
    {
        $doctor =
            $this->doctorService->update(
                $doctor,
                $request->validated()
            );

        return response()->json([
            'message' => 'Doctor updated successfully',
            'data' => new DoctorResource($doctor)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Doctor $doctor
    )
    {
        $this->doctorService
            ->delete($doctor);

        return response()->json([
            'message' => 'Doctor deleted successfully'
        ]);
    }
}
