<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobCategory;
use App\Models\Validation;

class ValidationController extends Controller
{
    public function index()
    {
        // Ambil data society yang sedang login
        $society = Auth::guard('society')->user();

        if (!$society) {
            return redirect()->route('login');
        }

        // Load relasi validation beserta jobCategory dan validator
        $society->load([
            'validation.jobCategory',
            'validation.validator'
        ]);

        // Ambil semua job categories untuk dropdown
        $jobCategories = JobCategory::all();

        return view('validation.index', compact('society', 'jobCategories'));
    }

    public function store(Request $request)
    {
        $society = Auth::guard('society')->user();

        if (!$society) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        // Cek apakah sudah ada validation
        if ($society->validation) {
            return response()->json([
                'success' => false,
                'message' => 'You already have a validation request'
            ], 400);
        }

        // Buat validation baru
        $validation = new Validation();
        $validation->society_id = $society->id;
        $validation->job_category_id = $request->job_category;
        $validation->work_experience = $request->work_experience;
        $validation->job_position = $request->job_position;
        $validation->reason_accepted = $request->reason_accepted;
        $validation->status = 'pending';
        $validation->save();

        return response()->json([
            'success' => true,
            'message' => 'Validation request submitted successfully'
        ]);
    }
}
