<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function showByEmailAndPassword(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->where('password', $password)->first();
        if ($user) {
            return response()->json([
                "message" => "User retrieved successfully",
                "user" => $user,
                "error" => false,
            ]);
        } else {
            return response()->json([
                "message" => "Invalid credentials",
                "error" => true,
            ]);
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $hashedPass = hash('sha256', $credentials['password']);
        $credentials['password'] = $hashedPass;

        // Log for debugging
        \Log::info('Hashed Password: ' . $hashedPass);
        \Log::info('Credentials: ' . json_encode($credentials));

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                "message" => "User authenticated successfully",
                "user" => $user
            ]);
        } else {
            return response()->json([
                "message" => "Invalid credentials"
            ]);
        }
    }
}
