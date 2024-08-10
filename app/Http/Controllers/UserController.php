<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Input email dan password',
            'password.required' => 'Input email dan password',
            'email.email' => 'Format email tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            if (User::where('email', $request->email)->exists()) {
                return redirect()->route('login')
                    ->withErrors(['password' => 'Password tidak terdaftar'])
                    ->withInput();
            } else {
                return redirect()->route('login')
                    ->withErrors(['email' => 'Email tidak terdaftar'])
                    ->withInput();
            }
        }

        if (!Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('login')
                ->withErrors(['password' => 'Password salah'])
                ->withInput();
        }

        return redirect()->intended('/welcome');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
