<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;


class DeviceController extends Controller
{
    public function index() {
        $devices = Device::all();
        return response()->json([
            "devices" => $devices
        ]);
    }

    public function show(Device $device) {
        $device = Device::device_user_pairing();
        return response()->json($device);
    }
}
