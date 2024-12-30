<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CashierController extends Controller
{
    public function dashboard()
    {
        return view('pages.cashier.dashboard');
    }

    public function createSale()
    {
        return view('pages.cashier.create_sale');
    }



    public  function settings()
    {
        return view('pages.cashier.settings');
    }


    public function changeProfilePic(Request $request)
    {

    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Optional: Add a success message
        return back()->with('success', 'Password updated successfully!');
    }



}
