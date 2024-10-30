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


        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();


            if (Auth::user()->role === 'cashier') {
                return redirect()->route('cashier');
            }

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin');
            }

            if (Auth::user()->role === 'god') {
                return redirect()->route('god');
            }
        }


        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials.',
            'password' => 'Invalid credentials.'
        ]);
    }

}
