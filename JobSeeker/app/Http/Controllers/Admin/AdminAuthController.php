<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            $admins = Auth::guard('admin')->user();

            Log::info($admins);

            $validator = Validator::where('user_id', $admins->id)->first();

            Log::info($validator);

            if ($admins) {
                Session::put('admin_id', $admins->id);
                Session::put('admin_name', $validator->name);
                Session::put('admin_role', $validator->role);
            }

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'username' => 'Username or Password incorrect',
        ])->onlyInput('username');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::forget(['admin_id', 'admin_name', 'admin_role']);
        return redirect()->route('admin.login');
    }
}
