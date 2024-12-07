<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    // Đăng ký người dùng mới
    public function register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // Đăng nhập người dùng
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return null; // Thất bại đăng nhập
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    // Đăng xuất người dùng
    public function logout($user)
    {
        $user->tokens()->delete();
        return true;
    }
}

