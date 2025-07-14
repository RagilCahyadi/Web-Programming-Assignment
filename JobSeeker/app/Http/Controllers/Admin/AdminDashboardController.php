<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Validation;
use App\Models\JobVacancy;
use App\Models\Society;
use App\Models\Validator;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function index()
    { 
 
        $adminId = Session::get('admin_id');
        $adminRole = Session::get('admin_role');

        $pendingValidations = Validation::where('status', 'pending')->count();
        $acceptedValidations = Validation::where('status', 'accepted')->count();
        $declinedValidations = Validation::where('status', 'declined')->count();

        $totalSocieties = Society::count();
        $totalVacancies = JobVacancy::count();

        // For validators, show validations assigned to them
        $assignedValidations = [];
        if ($adminRole === 'validator') {
            $validatorId = Validator::where('user_id', $adminId)->first()->id;
            $assignedValidations = Validation::with('society')
                ->where('validator_id', $validatorId)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();
        }

        return view('admin.dashboard.index', compact(
            'pendingValidations',
            'acceptedValidations',
            'declinedValidations',
            'totalSocieties',
            'totalVacancies',
            'assignedValidations',
            'adminRole'
        ));
    }
}
