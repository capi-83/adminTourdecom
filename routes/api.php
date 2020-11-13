<?php

use App\Http\Controllers\Auth\ApiController;
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

Route::middleware('api')->prefix('auth')->namespace('Auth')->group(function() {
    Route::post('login', [ApiController::class,'login']);
    Route::post('logout', [ApiController::class,'logout']);
    Route::post('refresh', [ApiController::class,'refresh']);
    Route::post('me', [ApiController::class,'me']);
});
