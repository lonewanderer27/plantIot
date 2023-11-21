<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;


class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return response()->json([
            "devices" => $devices,
            "error" => false,
            "success" => true
        ]);
    }

    public function show(Device $device)
    {
        $device = Device::device_user_pairing();
        if ($device) {
            return response()->json([
                "message" => "Device retrieved successfully",
                "device" => $device,
                "error" => false,
                "success" => true
            ]);
        } else {
            return response()->json([
                "message" => "Device not found",
                "error" => true,
                "success" => false
            ], 404);
        }
    }
}
