<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{

    /**
     * @throws \Exception
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'wrong email or password'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'email' => $user->email,
            'token' => $token
        ];

        return response($response, 201);
    }
}
