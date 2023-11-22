<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reading;

class ReadingController extends Controller
{
    public function index() {
        $readings = Reading::all();
        return response()->json([
            "readings" => $readings,
            "error" => false,
            "success" => true
        ]);
    }

    public function show(Reading $reading) {
        $reading = Reading::find($reading->id);
        if ($reading) {
            return response()->json([
                "message" => "Reading retrieved successfully",
                "reading" => $reading,
                "error" => false,
                "success" => true
            ]);
        } else {
            return response()->json([
                "message" => "Reading not found",
                "error" => true,
                "success" => false
            ], 404);
        }
    }

    public function showByDevice($device_id) {
        $readings = Reading::where('device_id', $device_id)->get();
        if ($readings) {
            return response()->json([
                "message" => "Readings retrieved successfully",
                "readings" => $readings,
                "error" => false,
                "success" => true
            ]);
        } else {
            return response()->json([
                "message" => "Readings not found",
                "error" => true,
                "success" => false
            ], 404);
        }
    }

    public function showLatestByUserAndDevice($user_id, $device_id) {
        $reading = Reading::where('device_id', $device_id)->orderBy('created_at', 'desc')->first();
        if ($reading) {
            return response()->json([
                "message" => "Reading retrieved successfully",
                "reading" => $reading,
                "error" => false,
                "success" => true
            ]);
        } else {
            return response()->json([
                "message" => "Reading not found",
                "error" => true,
                "success" => false
            ], 404);
        }
    }

    public function store(Request $request) {
        $validator = validator($request->all(), [
            'device_id' => 'required|integer',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'light_intensity' => 'required|numeric',
            'soil_moisture' => 'required|numeric',
            'water_level' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid data",
                "error" => true,
                "success" => false,
                "errors" => $validator->errors()
            ], 400); // Return HTTP status code 400 for Bad Request
        }

        $reading = Reading::create($request->all());
        return response()->json([
            "message" => "Reading created successfully",
            "reading" => $reading,
            "error" => false,
            "success" => true
        ], 201);
    }
}
