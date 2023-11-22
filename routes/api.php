<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceUserPairingController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['api.key'])->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/id/{id}', [UserController::class, 'show']);
    Route::get('users/email/{email}/password/{password}', [UserController::class, 'showByEmailAndPassword']);
    Route::post('users', [UserController::class, 'store']);

    Route::post('login', [LoginController::class,'verify']);

    Route::get('devices', [DeviceController::class, 'index']);
    Route::get('devices/id/{id}', [DeviceController::class, 'show']);
    Route::post('devices', [DeviceController::class, 'store']);

    Route::get('pairings', [DeviceUserPairingController::class, 'index']);
    Route::get('pairings/id/{id}', [DeviceUserPairingController::class, 'show']);
    Route::get('pairings/user/{user_id}', [DeviceUserPairingController::class, 'showByUser']);
    Route::get('pairings/device/{device_id}', [DeviceUserPairingController::class, 'showByDevice']);

    Route::get('readings', [ReadingController::class, 'index']);
    Route::get('readings/id/{id}', [ReadingController::class, 'show']);
    Route::get('readings/device_id/{device_id}', [ReadingController::class, 'showByDevice']);
    Route::get('readings/user/{user_id}/device/{device_id}/latest', [ReadingController::class, 'showLatestByUserAndDevice']);
    Route::post('readings', [ReadingController::class, 'store']);
});