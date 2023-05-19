<?php

use App\Http\Controllers\BikeBrandController;
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
//Route::prefix('columns')->group(function () {
//    Route::get('/bike_brands', [BikeBrandController::class, 'index']);
//    Route::get('/bike_brand/{id}', [BikeBrandController::class, 'show']);
//}); //還沒加 middleware

Route::resource('bike_brands', BikeBrandController::class)
    ->only('index', 'show', );
