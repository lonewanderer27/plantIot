<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            "users" => $users,
            "error"
        ]);
    }

    public function show(User $user)
    {
        $user = User::device_user_pairing();
        return response()->json([
            "user" => $user,
        ]);
    }

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

    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15',
            'age' => 'required|integer|min:1',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Validation failed",
                "error" => true,
                "errors" => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['password'] = hash('sha256', $data['password']);
        $user = User::create($data);

        return response()->json([
            "message" => "User created successfully",
            "error" => false,
            "user" => $user
        ]);
    }
}
