<?php

namespace App\Http\Controllers;

use App\Models\DeviceUserPairing;
use Illuminate\Http\Request;

class DeviceUserPairingController extends Controller
{
    public function index() {
        $pairings = DeviceUserPairing::all();
        return response()->json([
            "pairings" => $pairings,
            "error" => false,
            "success" => true
        ]);
    }

    public function show($id) {
        $pairing = DeviceUserPairing::find($id);
        if ($pairing) {
            return response()->json([
                "message" => "Pairing retrieved successfully",
                "pairing" => $pairing,
                "error" => false,
                "success" => true
            ]);
        } else {
            return response()->json([
                "message" => "Pairing not found",
                "error" => true,
                "success" => false
            ], 404);
        }
    }

    public function showByUser($user_id) {
        $pairings = DeviceUserPairing::where('user_id', $user_id)->get();
        if ($pairings) {
            return response()->json([
                "message" => "Pairings retrieved successfully",
                "pairings" => $pairings,
                "error" => false,
                "success" => true
            ]);
        } else {
            return response()->json([
                "message" => "Pairings not found",
                "error" => true,
                "success" => false
            ], 404);
        }
    }

    public function showByDevice($device_id) {
        $pairings = DeviceUserPairing::where('device_id', $device_id)->get();
        if ($pairings) {
            return response()->json([
                "message" => "Pairings retrieved successfully",
                "pairings" => $pairings,
                "error" => false,
                "success" => true
            ]);
        } else {
            return response()->json([
                "message" => "Pairings not found",
                "error" => true,
                "success" => false
            ], 404);
        }
    }

    public function showByUserAndDevice($user_id, $device_id) {
        $pairing = DeviceUserPairing::where('user_id', $user_id)->where('device_id', $device_id)->first();
        if ($pairing) {
            return response()->json([
                "message" => "Pairing retrieved successfully",
                "pairing" => $pairing,
                "error" => false,
                "success" => true
            ]);
        } else {
            return response()->json([
                "message" => "Pairing not found",
                "error" => true,
                "success" => false
            ], 404);
        }
    }

    public function store(Request $request) {
        $pairing = DeviceUserPairing::create($request->all());

        $validator = validator($request->all(), [
            'user_id' => 'required|integer',
            'device_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid data",
                "error" => true,
                "success" => false
            ], 400);
        } else {
            return response()->json([
                "message" => "Pairing created successfully",
                "pairing" => $pairing,
                "error" => false,
                "success" => true
            ], 201);
        }
    }
}
