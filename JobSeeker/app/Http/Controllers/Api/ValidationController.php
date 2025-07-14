<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Validation;
use App\Models\Society;

class ValidationController extends Controller
{
    public function store(Request $request)
    {
        $token = $request->query('token');
        $society = Society::where('login_tokens', $token)->first();

        if (!$society) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        // Check if society already has a validation request
        $existingValidation = Validation::where('society_id', $society->id)->first();
        if ($existingValidation) {
            return response()->json([
                'message' => 'You have already submitted a validation request'
            ], 400);
        }

        $request->validate([
            'job_category_id' => 'required|exists:job_categories,id',
            'work_experience' => 'required',
            'job_position' => 'required',
            'reason_accepted' => 'required',
        ]);

        Validation::create([
            'job_category_id' => $request->job_category_id,
            'society_id' => $society->id,
            'work_experience' => $request->work_experience,
            'job_position' => $request->job_position,
            'reason_accepted' => $request->reason_accepted,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Request data validation sent successful'
        ]);
    }

    public function show(Request $request)
    {
        $token = $request->query('token');
        $society = Society::where('login_tokens', $token)->first();

        if (!$society) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        $validation = Validation::with(['jobCategory', 'validator'])
            ->where('society_id', $society->id)
            ->first();

        return response()->json([
            'validation' => $validation ? [
                'id' => $validation->id,
                'status' => $validation->status,
                'work_experience' => $validation->work_experience,
                'job_category_id' => $validation->job_category_id,
                'job_position' => $validation->job_position,
                'reason_accepted' => $validation->reason_accepted,
                'validator_notes' => $validation->validator_notes,
                'validator' => $validation->validator
            ] : null
        ]);
    }
}
