<?php

use App\Http\Controllers\BikeBrandController;
use App\Http\Controllers\BikeModelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Manager\AuthController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\RegisterController;
use App\Http\Controllers\Customer\RegisterController as CustomerRegisterController;
use App\Http\Controllers\Customer\AuthController as CustomerAuthController;
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

// 尚未加入middleware
Route::resource('bike-brands', BikeBrandController::class)
    ->only('index', 'show', 'store', 'update', 'destroy');
Route::resource('bike-models', BikeModelController::class)
    ->only('index', 'show', 'store', 'update', 'destroy');

Route::apiResource('products', ProductController::class)->only('index', 'store');

Route::prefix('customer')->group(function () {
    Route::post('register', [CustomerRegisterController::class, 'register']);
    Route::post('login', [CustomerAuthController::class, 'login']);
});

Route::prefix('manager')->group(function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:manager')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::apiResource('managers', ManagerController::class)
            ->only('index', 'show', 'store', 'update', 'destroy');
    });
});
