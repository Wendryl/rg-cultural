<?php

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
});

Route::get('/home', function () {
    return view('user-dashboard');
});

Route::get('/completar-cadastro', function () {
    return view('complete-registration');
});

Route::get('/registrar', function () {
    return view('cadastro');
});

Route::get('/descobrir', function () {
    return view('descobrir');
});

Route::get('/sobre_nos', function () {
    return view('sobre_nos');
});

Route::get('/admin', function () {
    return view('admin');
});
