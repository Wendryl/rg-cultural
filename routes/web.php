<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'loginSite']);

Route::get('/home', function () {
    $user = auth()->user();
    return view('user-dashboard/index', ['user' => $user]);
})->middleware('auth');

Route::get('/completar-cadastro', function () {
    $user = auth()->user();
    return view('user-dashboard/complete-registration', ['user' => $user]);
})->middleware('auth');

Route::post('/new-user', [UserController::class, 'storeSite'])->middleware('auth');

Route::put('/update', [UserController::class, 'updateSite'])->middleware('auth');
Route::put('/update/{id}', [UserController::class, 'updateSite'])->middleware('auth');

Route::get('/logout', [UserController::class, 'logoutSite']);

Route::get('/registrar', function () {
    return view('cadastro');
});

Route::post('/register', [UserController::class, 'storeSite']);

Route::get('/descobrir', function () {
    return view('descobrir');
});

Route::get('/sobre_nos', function () {
    return view('sobre_nos');
});

Route::get('/admin', function () {
    $users = User::paginate(15);
    return view('admin-dashboard/index', ['users' => $users]);
});
