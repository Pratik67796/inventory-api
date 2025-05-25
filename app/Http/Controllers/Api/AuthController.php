<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Log;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->authService->register($request->validated());
            return response()
                ->json([
                    'message' => __('api_message.user_register'),
                    'data' => $user,
                ], 200);
        } catch (\Exception $e) {
            Log::info("Error in register user: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->authService->login($request->validated());
            return response()
                ->json([
                    'message' => __('api_message.login_sucess'),
                    'data' => $user,
                ], 200);
        } catch (ValidationException $e) {
            Log::info("Error in login: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request->user());
            return response()
                ->json([
                    'message' => __('api_message.logout'),
                    'data' => null,
                ], 200);
        } catch (\Exception $e) {
            Log::info("Error in logout: " . $e->getMessage());
            return response()->json(['data' => ['errors' => 'Something went wrong!']], 500);
        }
    }
}