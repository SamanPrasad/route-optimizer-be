<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Client\Request;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService) {}

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = $this->authService->register($validated);
        return $user;
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login(
            $request->validated()
        );

        return response()->json([
            'message' => 'Login successful',
            'data' => $data
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
