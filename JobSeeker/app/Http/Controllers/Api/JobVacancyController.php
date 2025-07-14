<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\Society;

class JobVacancyController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->query('token');
        $society = Society::with('validation')->where('login_tokens', $token)->first();

        if (!$society) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        // Check if society has validation and it's accepted
        if (!$society->validation) {
            return response()->json(['message' => 'Your data validator must be accepted by validator before'], 400);
        }

        $jobVacancies = JobVacancy::with(['jobCategory', 'availablePositions.jobApplyPositions'])
            ->where('job_category_id', $society->validation->job_category_id)
            ->get();

        $vacancies = $jobVacancies->map(function ($vacancy) {
            return [
                'id' => $vacancy->id,
                'category' => [
                    'id' => $vacancy->jobCategory->id,
                    'job_category' => $vacancy->jobCategory->job_category,
                ],
                'company' => $vacancy->company,
                'address' => $vacancy->address,
                'description' => $vacancy->description,
                'available_position' => $vacancy->availablePositions->map(function ($position) {
                    return [
                        'position' => $position->position,
                        'capacity' => $position->capacity,
                        'apply_capacity' => $position->apply_capacity,
                    ];
                })
            ];
        });

        return response()->json(['vacancies' => $vacancies]);
    }

    public function show(Request $request, $id)
    {
        $token = $request->query('token');
        $society = Society::where('login_tokens', $token)->first();

        if (!$society) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        $jobVacancy = JobVacancy::with(['jobCategory', 'availablePositions.jobApplyPositions'])
            ->findOrFail($id);

        $vacancy = [
            'id' => $jobVacancy->id,
            'category' => [
                'id' => $jobVacancy->jobCategory->id,
                'job_category' => $jobVacancy->jobCategory->job_category,
            ],
            'company' => $jobVacancy->company,
            'address' => $jobVacancy->address,
            'description' => $jobVacancy->description,
            'available_position' => $jobVacancy->availablePositions->map(function ($position) {
                return [
                    'position' => $position->position,
                    'capacity' => $position->capacity,
                    'apply_capacity' => $position->apply_capacity,
                    'apply_count' => $position->jobApplyPositions->count(),
                ];
            })
        ];

        return response()->json(['vacancy' => $vacancy]);
    }
}
