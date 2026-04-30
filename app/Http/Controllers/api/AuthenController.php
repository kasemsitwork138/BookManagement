<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenController extends Controller
{
        public function login()
    {
        $validated = request()->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // $findUser = User::where('email', $validated['email'])->first();

        $user = Auth::attempt($validated);
        Log::debug('Login attempt for email: ' . $validated['email'] . ' - ' . ($user ? 'Success' : 'Failure'));

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
            ], 401);
        }

        // $accessToken = $user->createToken('access-token')->plainTextToken;

        // $refreshToken = Str::random(64);

         $accessToken = Auth::user()->createToken('access-token')->plainTextToken;

        // DB::table('refresh_tokens')->insert([
        //     'user_id' => $findUser->id,
        //     'token_hash' => hash('sha256', $refreshToken),
        //     'expires_at' => now()->addDays(30),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        return response()->json([
            'status' => 'success',
            'message' => 'เข้าสู่ระบบสำเร็จ',
            'access_token' => $accessToken,
            'user' => Auth::user(),
            // 'refresh_token' => $refreshToken,
        ]);
    }
}
