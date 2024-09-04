<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
     public function register(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::create($data);
        $user->assignRole('user');
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        return response(['success'=>true,'token' => $token], 200);
    }
    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response(['success'=>true,'token' => $token], 200);
        }

        return response(['error' => 'Unauthorized'], 401);
    }

    // Handle logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logged out successfully'], 200);
    }
}
