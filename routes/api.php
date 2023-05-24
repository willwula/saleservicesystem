<?php

use App\Http\Controllers\BikeBrandController;
use App\Http\Controllers\BikeModelController;
use App\Http\Controllers\ProductController;
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

// 尚未加入middleware
Route::resource('bike-brands', BikeBrandController::class)
    ->only('index', 'show', 'store', 'update', 'destroy');
Route::resource('bike-models', BikeModelController::class)
    ->only('index', 'show', 'store');

Route::apiResource('products', ProductController::class)->only('index','store');
