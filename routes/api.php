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
    Route::post('/users/{id}/update', 'update'); // Change all update POST methods to PUT after deploy in another hosting service
    Route::post('/users/{id}/delete', 'destroy'); // Change all delete POST methods to PUT after deploy in another hosting service
});

Route::controller(CategoryController::class)->group(function() {
    Route::get('/categories', 'index');
    Route::get('/categories/{id}', 'show');
    Route::post('/categories', 'store');
    Route::post('/categories/{id}/update', 'update');
    Route::post('/categories/{id}/delete', 'destroy');
});

Route::controller(ActivityController::class)->group(function() {
    Route::get('/activities', 'index');
    Route::get('/activities/{id}', 'show');
    Route::post('/activities', 'store');
    Route::post('/activities/{id}/update', 'update');
    Route::post('/activities/{id}/delete', 'destroy');
});
