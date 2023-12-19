<?php

use App\Http\Controllers\Api\EmployeeApiController;
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


Route::post('send-otp', [EmployeeApiController::class, 'sendOtp']);
Route::post('verify-otp', [EmployeeApiController::class, 'verifyOtp']);
Route::patch('fcm-token', [EmployeeApiController::class, 'updateFcmToken']);
Route::get('tour-programe', [EmployeeApiController::class, 'tourProgrameByEmployee']);

