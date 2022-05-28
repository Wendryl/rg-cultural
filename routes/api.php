<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SubCategoryController;
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
    Route::get('/users/by-email/{email}', 'findByEmail');
    Route::post('/users', 'store');
    Route::put('/users/{id}', 'update'); // Change all update POST methods to PUT after deploy in another hosting service
    Route::delete('/users/{id}', 'destroy'); // Change all delete POST methods to PUT after deploy in another hosting service
    Route::post('/users/login', 'login');
    Route::get('/users/logout/{email}', 'logout');
});

Route::controller(CategoryController::class)->group(function() {
    Route::get('/categories', 'index');
    Route::get('/categories/{id}', 'show');
    Route::post('/categories', 'store');
    Route::put('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'destroy');
});

Route::controller(SubCategoryController::class)->group(function() {
    Route::get('/sub-categories', 'index');
    Route::get('/sub-categories/{id}', 'show');
    Route::get('/sub-categories-by-category/{id}', 'findByCategory');
    Route::post('/sub-categories', 'store');
    Route::put('/sub-categories/{id}', 'update');
    Route::delete('/sub-categories/{id}', 'destroy');
});

Route::controller(ActivityController::class)->group(function() {
    Route::get('/activities', 'index');
    Route::get('/activities/{id}', 'show');
    Route::post('/activities', 'store');
    Route::put('/activities/{id}', 'update');
    Route::delete('/activities/{id}', 'destroy');
});
