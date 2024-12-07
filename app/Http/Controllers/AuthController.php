<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     // Đăng ký
     public function register(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:8',
         ]);
 
         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);
 
         return response()->json([
             'message' => 'User registered successfully',
             'user' => $user
         ], 201);
     }
 
     // Đăng nhập
     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|string|email',
             'password' => 'required|string',
         ]);
 
         if (!Auth::attempt($request->only('email', 'password'))) {
             return response()->json([
                 'message' => 'Invalid login credentials'
             ], 401);
         }
 
         $user = Auth::user();
         $token = $user->createToken('auth_token')->plainTextToken;
 
         return response()->json([
             'message' => 'Login successful',
             'token' => $token,
             'user' => $user
         ]);
     }
 
     // Đăng xuất
     public function logout(Request $request)
     {
         $request->user()->tokens()->delete();
 
         return response()->json([
             'message' => 'Logged out successfully'
         ]);
     }
}