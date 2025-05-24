<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // $user['token'] = $user->createToken('auth_token')->plainTextToken;
        
        return response()
            ->json([
                'message' => __('api_message.user_register'),
                'data' => $user,
            ], 200);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
             return response()
            ->json([
                'message' => __('api_message.invalid_credentials'),
                'data' => null,
            ], 200);
        }

        $user['token'] = $user->createToken('auth_token')->plainTextToken;
        
        return response()
            ->json([
                'message' => __('api_message.login_sucess'),
                'data' => $user,
            ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()
            ->json([
                'message' => __('api_message.logout'),
                'data' => null,
            ], 200);
    }
}