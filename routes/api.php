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

Route::post('start-programe', [EmployeeApiController::class, 'startTourPrograme']);
Route::post('end-programe', [EmployeeApiController::class, 'endTourPrograme']);

Route::get('gifts', [EmployeeApiController::class, 'get_gifts']);
Route::get('products', [EmployeeApiController::class, 'get_products']);

Route::post('post-visit', [EmployeeApiController::class, 'post_visit']);
Route::get('get-visits', [EmployeeApiController::class, 'getVisits']);
Route::get('employee-tracking', [EmployeeApiController::class, 'get_employee_tracking']);
Route::post('post-order-gift', [EmployeeApiController::class, 'post_add_order_product']);

