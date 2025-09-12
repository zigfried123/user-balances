<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'string',
            'email' => 'required|email|unique',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {

            $token = Auth::user()->createToken('auth_token');

            return ['token' => $token->plainTextToken];
        }

        throw new AuthenticationException();

    }

    public function dashboard(Request $request)
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        $operations = $user->lastOperations(5)->get();

        return ['balances'=>$user->balances, 'operations'=>$operations];
    }

    public function history(Request $request)
    {
        return $request->user()->operations()->orderBy('created_at','asc')->get();
    }
}
