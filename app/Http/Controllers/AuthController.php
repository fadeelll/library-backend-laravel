<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request) {
    // 1. Cek apakah Request kosong atau tidak
    if (!$request->has('email') || !$request->has('password')) {
        return response()->json([
            'message' => 'Data Request Kosong! Cek baris kosong di REST Client kamu.',
            'debug_input' => $request->all()
        ], 400);
    }

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    // 2. Debug jika User tidak ketemu
    if (!$user) {
        return response()->json([
            'message' => 'Email tidak terdaftar!',
            'email_yang_dikirim' => $request->email
        ], 401);
    }

    // 3. Debug Password (ini yang krusial)
    if (!Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Password salah bro!',
            'debug' => [
                'password_input' => $request->password,
                'password_di_db' => $user->password, // Ini akan menunjukkan apakah password di DB itu hash atau plain
                'apakah_cocok' => Hash::check($request->password, $user->password)
            ]
        ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ]);
}
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Berhasil Logout']);
    }
}