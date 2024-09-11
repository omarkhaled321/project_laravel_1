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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']), // Hash the password
        ]);

        $user->assignRole('user');
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        return response(['success' => true, 'data' => null], Response::HTTP_NO_CONTENT);    }
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

            return response(['success' => true, 'data' => null], Response::HTTP_NO_CONTENT);
        }

        return response(['success' => true, 'data' => null], Response::HTTP_NO_CONTENT);
    }

    // Handle logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(['success' => true, 'data' => null], Response::HTTP_NO_CONTENT);
    }
}
