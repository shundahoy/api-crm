<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartContoroller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgressContoroller;
use App\Http\Controllers\StatusContoroller;
use App\Models\Progress;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/users/info', [AuthController::class, 'updateInfo']);
    Route::put('/users/password', [AuthController::class, 'updatePassword']);

    Route::apiResource('customer', CustomerController::class);
    Route::apiResource('order', OrderController::class);
    Route::get('/product/page', [ProductController::class, 'indexPage']);
    Route::apiResource('product', ProductController::class);


    Route::post('/search', [CustomerController::class, 'search']);
    Route::get('/chart/day', [ChartContoroller::class, 'day']);
    Route::get('/chart/month', [ChartContoroller::class, 'month']);
    Route::get('/progress', [ProgressContoroller::class, 'index']);
    Route::get('/status', [StatusContoroller::class, 'index']);
});
