<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Society;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('society')->check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id_card_number' => 'required|string',
            'password' => 'required|string',
        ]);

        // Gunakan Laravel Auth dengan custom field
        $credentials = [
            'id_card_number' => $request->id_card_number,
            'password' => $request->password,
        ];

        if (Auth::guard('society')->attempt($credentials)) {
            $request->session()->regenerate();

            $society = Auth::guard('society')->user();
            if ($society) {
                Session::put('society_id', $society->id);
                Session::put('society_name', $society->name);
                // atau
                session(['society_id' => $society->id]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => route('dashboard')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'ID Card Number or Password incorrect'
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::guard('society')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
