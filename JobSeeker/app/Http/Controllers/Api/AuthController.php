<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Society;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'id_card_number' => 'required',
            'password' => 'required',
        ]);

        $society = Society::with('regional')
            ->where('id_card_number', $request->id_card_number)
            ->first();

        if ($society && Hash::check($request->password, $society->password)) {
            $token = $society->generateToken();
            $society->update(['login_tokens' => $token]);

            return response()->json([
                'name' => $society->name,
                'born_date' => $society->born_date->format('Y-m-d'),
                'gender' => $society->gender,
                'address' => $society->address,
                'token' => $token,
                'regional' => [
                    'id' => $society->regional->id,
                    'province' => $society->regional->province,
                    'district' => $society->regional->district
                ]
            ]);
        }

        return response()->json([
            'message' => 'ID Card Number or Password incorrect'
        ], 401);
    }

    public function logout(Request $request)
    {
        $token = $request->query('token');

        $society = Society::where('login_tokens', $token)->first();

        if ($society) {
            $society->update(['login_tokens' => null]);
            return response()->json(['message' => 'Logout success']);
        }

        return response()->json(['message' => 'Invalid token'], 401);
    }
}
