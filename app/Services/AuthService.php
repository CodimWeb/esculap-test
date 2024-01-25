<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function registration(string $email, string $password): User
    {
        $password = Hash::make($password);
        $user = User::create([
            'email' => $email,
            'password' => $password
        ]);

        return $user;
    }

    public function login(string $email, string $password)
    {
        $user = User::whereEmail($email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Incorrect email or password',
            ], 422));
        }

        return [
            'success'   => true,
            'type'      => 'Bearer',
            'access_token'     => $user->createToken('api')->plainTextToken,
            'user'      => $user,
        ];
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}
