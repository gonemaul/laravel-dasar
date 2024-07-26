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
}
