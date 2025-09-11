<?php

namespace App\Http\Controllers\Api;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {

            $token = Auth::user()->createToken('auth_token');

            return ['token' => $token->plainTextToken];
        }

        throw new AuthenticationException();

    }

    public function dashboard()
    {

    }

    public function history()
    {

    }
}
