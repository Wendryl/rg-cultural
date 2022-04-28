<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
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

Route::controller(UserController::class)->group(function() {
    Route::get('/users', 'index');
    Route::get('/users/{id}', 'show');
    Route::post('/users', 'store');
    Route::put('/users/{id}', 'update');
    Route::delete('/users/{id}', 'destroy');
});

Route::controller(CategoryController::class)->group(function() {
    Route::get('/categories', 'index');
    Route::get('/categories/{id}', 'show');
    Route::post('/categories', 'store');
    Route::put('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'destroy');
});

Route::controller(ActivityController::class)->group(function() {
    Route::get('/activities', 'index');
    Route::get('/activities/{id}', 'show');
    Route::post('/activities', 'store');
    Route::put('/activities/{id}', 'update');
    Route::delete('/activities/{id}', 'destroy');
});
