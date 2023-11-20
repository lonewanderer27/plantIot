<?php

namespace App\Http\Controllers;

use App\Models\DeviceUserPairing;
use Illuminate\Http\Request;

class DeviceUserPairingController extends Controller
{
    public function index() {
        $pairings = DeviceUserPairing::all();
        return response()->json([
            "pairings" => $pairings
        ]);
    }
}
