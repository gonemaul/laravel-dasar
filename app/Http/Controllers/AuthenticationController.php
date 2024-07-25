<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email', 'max:250', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        User::create($validatedData);

        return back()->withSuccess('You have successfully registered');
    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(!Auth::attempt($credentials)){
            return back()->withError([
                'email' => 'Your provided credentials do not match in our records.',
            ])->onlyInput('email');
        }

        return to_route('dashboard')
            ->withSuccess('You have successfully logged in!');
    }

    public function dashboard(){
        return view('auth.dashboard');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login')->withSuccess('You have logged successfully!');
    }
}
