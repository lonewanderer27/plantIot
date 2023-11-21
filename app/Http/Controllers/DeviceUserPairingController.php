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

    public function show($id) {
        $pairing = DeviceUserPairing::find($id);
        return response()->json([
            "pairing" => $pairing
        ]);
    }

    public function showByUser($user_id) {
        $pairings = DeviceUserPairing::where('user_id', $user_id)->get();
        return response()->json([
            "pairings" => $pairings
        ]);
    }

    public function showByDevice($device_id) {
        $pairings = DeviceUserPairing::where('device_id', $device_id)->get();
        return response()->json([
            "pairings" => $pairings
        ]);
    }

    public function store(Request $request) {
        $pairing = DeviceUserPairing::create($request->all());
        return response()->json([
            "message" => "Pairing created successfully",
            "pairing" => $pairing
        ]);
    }
}
