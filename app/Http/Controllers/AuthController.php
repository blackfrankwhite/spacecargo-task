<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        $user = \App\Models\User::where('username', $request->username)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (\Auth::attempt($credentials)) {
            $token = $user->createToken('authToken')->plainTextToken;
            
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

}
