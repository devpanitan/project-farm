<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmCategoryController;
use App\Http\Controllers\FarmController; 
use App\Http\Controllers\IotDeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route for the FarmCategory resource
Route::apiResource('farm-categories', FarmCategoryController::class);

// Route for the new Farm resource
Route::apiResource('farms', FarmController::class);

// Route for the new IotDevice resource
Route::apiResource('iot-devices', IotDeviceController::class);
