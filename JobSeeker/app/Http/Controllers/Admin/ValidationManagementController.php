<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Validation;
use App\Models\Validator;
use Illuminate\Support\Facades\Session;

class ValidationManagementController extends Controller
{
    public function index()
    {
        $adminId = Session::get('admin_id');
        $adminRole = Session::get('admin_role');

        $query = Validation::with(['society', 'jobCategory', 'validator']);

        // If validator, only show validations assigned to them
        if ($adminRole === 'validator') {
            $validatorId = Validator::where('user_id', $adminId)->first()->id;
            $query->where('validator_id', $validatorId);
        }

        $validations = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.validations.index', compact('validations', 'adminRole'));
    }

    public function show($id)
    {
        $validation = Validation::with(['society.regional', 'jobCategory', 'validator'])
            ->findOrFail($id);

        $adminRole = Session::get('admin_role');

        // If officer, they can assign validators
        $validators = [];
        if ($adminRole === 'officer') {
            $validators = Validator::where('role', 'validator')->get();
        }

        return view('admin.validations.show', compact('validation', 'adminRole', 'validators'));
    }

    public function update(Request $request, $id)
    {
        $validation = Validation::findOrFail($id);

        $request->validate([
            'status' => 'required|in:accepted,declined',
            'validator_notes' => 'nullable|string',
        ]);

        $adminId = Session::get('admin_id');
        $validatorId = Validator::where('user_id', $adminId)->first()->id;

        $validation->update([
            'status' => $request->status,
            'validator_notes' => $request->validator_notes,
            'validator_id' => $validatorId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Validation status updated successfully'
        ]);
    }

    public function assign(Request $request, $id)
    {
        $validation = Validation::findOrFail($id);

        $request->validate([
            'validator_id' => 'required|exists:validators,id',
        ]);

        $validation->update([
            'validator_id' => $request->validator_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Validator assigned successfully'
        ]);
    }
}
