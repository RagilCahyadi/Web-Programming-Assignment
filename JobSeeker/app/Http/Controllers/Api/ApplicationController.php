<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplySociety;
use App\Models\JobApplyPosition;
use App\Models\Society;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $token = $request->query('token');
        $society = Society::with('validation')->where('login_tokens', $token)->first();

        if (!$society) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        if (!$society->validation || $society->validation->status !== 'accepted') {
            return response()->json([
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
        $existingApplication = JobApplySociety::where('society_id', $society->id)
            ->where('job_vacancy_id', $request->vacancy_id)
            ->first();

        if ($existingApplication) {
            return response()->json([
                'message' => 'Application for a job can only be once'
            ], 401);
        }

        DB::transaction(function () use ($request, $society) {
            $application = JobApplySociety::create([
                'notes' => $request->notes,
                'date' => now()->toDateString(),
                'society_id' => $society->id,
                'job_vacancy_id' => $request->vacancy_id,
            ]);

            foreach ($request->positions as $positionId) {
                JobApplyPosition::create([
                    'date' => now()->toDateString(),
                    'society_id' => $society->id,
                    'job_vacancy_id' => $request->vacancy_id,
                    'position_id' => $positionId,
                    'job_apply_societies_id' => $application->id,
                    'status' => 'pending'
                ]);
            }
        });

        return response()->json([
            'message' => 'Applying for job successful'
        ]);
    }

    public function index(Request $request)
    {
        $token = $request->query('token');
        $society = Society::where('login_tokens', $token)->first();

        if (!$society) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        $applications = JobApplySociety::with([
            'jobVacancy.jobCategory',
            'jobApplyPositions.availablePosition'
        ])->where('society_id', $society->id)->get();

        $vacancies = $applications->map(function ($application) {
            return [
                'id' => $application->jobVacancy->id,
                'category' => [
                    'id' => $application->jobVacancy->jobCategory->id,
                    'job_category' => $application->jobVacancy->jobCategory->job_category,
                ],
                'company' => $application->jobVacancy->company,
                'address' => $application->jobVacancy->address,
                'position' => $application->jobApplyPositions->map(function ($position) {
                    return [
                        'position' => $position->availablePosition->position,
                        'apply_status' => $position->status,
                        'notes' => $position->jobApplySociety->notes,
                    ];
                })
            ];
        });

        return response()->json(['vacancies' => $vacancies]);
    }
}
