<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;

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


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'auth:sanctum'], function() {
  Route::get('logout', [AuthController::class, 'logout']);
  Route::get('user', [AuthController::class, 'user']);

  Route::group(['prefix' => 'cars'], function () {
    Route::get('/', [CarController::class, 'index']);
    Route::get('/{car}', [CarController::class, 'show']);
    Route::post('/', [CarController::class, 'store']);
    Route::post('/{car}', [CarController::class, 'update']);
    Route::delete('/{car}', [CarController::class, 'destroy']);
  });
});