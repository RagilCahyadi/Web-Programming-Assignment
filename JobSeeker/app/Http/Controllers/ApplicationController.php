<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplySociety;
use App\Models\JobApplyPosition;
use App\Models\Society;
use App\Models\AvailablePosition;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function index()
    {
        $societyId = Session::get('society_id');

        $applications = JobApplySociety::with([
            'jobVacancy.jobCategory',
            'jobApplyPositions.availablePosition'
        ])->where('society_id', $societyId)->get();

        return view('applications.index', compact('applications'));
    }

    public function store(Request $request)
    {
        $societyId = Session::get('society_id');
        $society = Society::with('validation')->find($societyId);

        if (!$society || !$society->validation || $society->validation->status !== 'accepted') {
            return response()->json([
                'success' => false,
                'message' => 'Your data validator must be accepted by validator before'
            ], 401);
        }

        $request->validate([
            'vacancy_id' => 'required|exists:job_vacancies,id',
            'positions' => 'required|array',
            'positions.*' => 'exists:available_positions,id',
            'notes' => 'required',
        ]);

        // Check if already applied
        $existingApplication = JobApplySociety::where('society_id', $societyId)
            ->where('job_vacancy_id', $request->vacancy_id)
            ->first();

        if ($existingApplication) {
            return response()->json([
                'success' => false,
                'message' => 'Application for a job can only be once'
            ], 401);
        }

        DB::transaction(function () use ($request, $societyId) {
            $application = JobApplySociety::create([
                'notes' => $request->notes,
                'date' => now()->toDateString(),
                'society_id' => $societyId,
                'job_vacancy_id' => $request->vacancy_id,
            ]);

            foreach ($request->positions as $positionId) {
                JobApplyPosition::create([
                    'date' => now()->toDateString(),
                    'society_id' => $societyId,
                    'job_vacancy_id' => $request->vacancy_id,
                    'position_id' => $positionId,
                    'job_apply_societies_id' => $application->id,
                    'status' => 'pending'
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully'
        ]);
    }
}
