<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'max:250', 'string'],
            'email' => ['required', 'max:250', 'unique:users', 'email'],
            'password' => ['required', 'max:16', 'min:6']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
           'message' => 'Registration successful'
        ]);
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(!auth()->attempt($validatedData)){
            return response()->json([
               'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'You have successfully logged in',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function me(Request $request){
        $user = $request->user();

        return response()->json([
            'user' => $user
        ]);
    }

    public function logout(Request $request){
       $request->user()->tokens()->delete();

        return response()->json([
           'message' => 'You have logged out successfully'
        ]);
    }
}
