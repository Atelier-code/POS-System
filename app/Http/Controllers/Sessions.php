<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sessions extends Controller
{

    public function index(){
       return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'cashier') {
                return redirect()->route('cashier.dashboard');
            }

            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials.',
            'password' => 'Invalid credentials.'
        ]);
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
