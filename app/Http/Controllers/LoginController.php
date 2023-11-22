<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function verify(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                "message" => "Invalid credentials",
                "error" => true,
                "success" => false,
                "errors" => $errors,
            ]);
        }

        $email = $request->email;
        $password = hash('sha256', $request->password);

        $user = User::where('email', $email)->where('password', $password)->first();
        if ($user) {
            return response()->json([
                "message" => "User retrieved successfully",
                "user" => $user,
                "error" => false,
                "success" => true
            ]);
        } else {
            return response()->json([
                "message" => "Invalid credentials",
                "error" => true,
                "success" => false,
            ]);
        }
    }
}
