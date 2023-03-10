<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $credentials): User
    {
        return User::create([
            'login' => $credentials['login'],
            'password' => Hash::make($credentials['password']),
        ]);
    }

    public function login(array $credentials): User
    {
        if (!auth()->attempt($credentials)) {
            throw new AuthenticationException();
        }

        return auth()->user();
    }
}
