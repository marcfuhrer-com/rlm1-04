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
        /*$contentType = request()->header('Content-Type');

        if ($contentType !== 'application/json') {
            $response = ['message' => 'Unsupported Media Type'
            ];
            return response($response, 415);
        }*/

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
            'userEmail' => $user->email,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response([
            'message' => 'you successfully logged out'
        ], 200);
    }
}
