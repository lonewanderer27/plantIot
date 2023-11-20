<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return response()->json([
            "users" => $users
        ]);
    }

    public function show(User $user) {
        $user = User::device_user_pairing();
        return response()->json($user);
    }
}
