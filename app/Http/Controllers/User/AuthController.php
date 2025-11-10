<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegesterRequest;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{


    public function regester(RegesterRequest $request)
    {
        $credentials = $request->validated();
    

        User::create($credentials);
        
        return response()->json([
            "message" => "User registered successfully",
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }


    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
