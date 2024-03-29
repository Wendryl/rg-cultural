<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CulturalColumnController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::middleware('auth_api')->controller(UserController::class)->group(function() {
    Route::get('/users', 'index');
    Route::get('/users/{id}', 'show');
    Route::get('/users/by-email/{email}', 'findByEmail');
    Route::post('/users', 'store')->withoutMiddleware('auth_api');
    Route::put('/users/{id}', 'update');
    Route::post('/users/{id}/profile-picture', 'updateProfilePicture');
    Route::delete('/users/{id}', 'destroy');
    Route::get('/logout', 'logout');
    Route::post('/login', 'login')->withoutMiddleware('auth_api');
});

Route::middleware('auth_api')->controller(CategoryController::class)->group(function() {
    Route::get('/categories', 'index');
    Route::get('/categories/{id}', 'show');
    Route::post('/categories', 'store');
    Route::put('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'destroy');
});

Route::middleware('auth_api')->controller(SubCategoryController::class)->group(function() {
    Route::get('/sub-categories', 'index');
    Route::get('/sub-categories/{id}', 'show');
    Route::get('/sub-categories-by-category/{id}', 'findByCategory');
    Route::post('/sub-categories', 'store');
    Route::put('/sub-categories/{id}', 'update');
    Route::delete('/sub-categories/{id}', 'destroy');
});

Route::middleware('auth_api')->controller(ActivityController::class)->group(function() {
    Route::get('/activities', 'index');
    Route::get('/activities/{id}', 'show');
    Route::post('/activities', 'store');
    Route::put('/activities/{id}', 'update');
    Route::delete('/activities/{id}', 'destroy');
});

Route::middleware('auth_api')->controller(AgendaController::class)->group(function() {
    Route::get('/agendas', 'index');
    Route::get('/agendas/{id}', 'show');
    Route::post('/agendas', 'store');
    Route::put('/agendas/{id}', 'update');
    Route::delete('/agendas/{id}', 'destroy');
});

Route::middleware('auth_api')->controller(CulturalColumnController::class)->group(function() {
    Route::get('/cultural-columns', 'index');
    Route::get('/cultural-columns/{id}', 'show');
    Route::post('/cultural-columns', 'store');
    Route::put('/cultural-columns/{id}', 'update');
    Route::post('/cultural-columns/{id}/picture', 'updateColumnPicture');
    Route::delete('/cultural-columns/{id}', 'destroy');
});
