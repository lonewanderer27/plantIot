<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceUserPairingController;
use App\Models\DeviceUserPairing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);

Route::get('devices', [DeviceController::class, 'index']);
Route::get('devices/{id}', [DeviceController::class, 'show']);
Route::post('devices', [DeviceController::class, 'store']);

Route::get('pairings', [DeviceUserPairingController::class, 'index']);
Route::get('pairings/id/{id}', [DeviceUserPairingController::class, 'show']);
Route::get('pairings/user/{user_id}', [DeviceUserPairingController::class, 'showByUser']);
Route::get('pairings/device/{device_id}', [DeviceUserPairingController::class, 'showByDevice']);

Route::post('pairings', [DeviceUserPairingController::class, 'store']);