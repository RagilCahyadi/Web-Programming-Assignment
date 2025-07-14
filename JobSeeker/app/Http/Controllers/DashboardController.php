<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Society;

class DashboardController extends Controller
{
    public function index()
    {
        // Jika menggunakan Laravel Auth
        if (Auth::guard('society')->check()) {
            $society = Auth::guard('society')->user();
        }
        // Jika menggunakan session manual
        elseif (Session::has('society_id')) {
            $society = Society::find(Session::get('society_id'));
        } else {
            return redirect()->route('login');
        }

        // Load relasi validation beserta jobCategory dan validator
        $society->load([
            'validation.jobCategory',
            'validation.validator'
        ]);

        return view('dashboard.index', compact('society'));
    }
}
