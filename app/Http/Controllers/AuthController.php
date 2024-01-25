<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function registration(RegisterRequest $request, AuthService $authService): JsonResponse
    {

        $user = $authService->registration(
            $request->post('email'),
            $request->post('password'),
        );

        return response()->json([
            'access_token' => $user->createToken('api')->plainTextToken,
            'user' => $user,
            'success' => true
        ]);
    }

    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        return response()->json(
            $authService->login(
                $request->post('email'),
                $request->post('password'),
            )
        );
    }

    public function me()
    {
        return auth()->user();
    }

    public function logout(): JsonResponse
    {
        return response()->json(
            [
                'success' => true,
            ]
        );
    }
}
