<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $token = $user->createToken('doctor-api');

        return response()->json([
            'message'=>'Registration successful',
            'token'=>$token->plainTextToken,
            'user'=>$user
        ],201);
    }

    public function login(LoginRequest $request)
    {
        if(!Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]))
        {
            return response()->json([
                'message'=>'Invalid credentials'
            ],401);
        }

        $user = Auth::user();

        $token = $user->createToken('doctor-api');

        return response()->json([
            'message'=>'Login successful',
            'token'=>$token->plainTextToken,
            'user'=>$user
        ]);
    }

    public function logout()
    {
        auth()->user()
              ->currentAccessToken()
              ->delete();

        return response()->json([
            'message'=>'Logged out successfully'
        ]);
    }
}
