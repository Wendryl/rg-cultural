<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

// Public site routes
Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'loginSite']);

Route::get('/register', function () {
    return view('cadastro');
});

Route::post('/register', [UserController::class, 'storeSite']);

Route::get('/discover', function () {
    return view('descobrir');
});

Route::get('/about', function () {
    return view('sobre_nos');
});

// Restricted areas routes (User/Admin)
Route::middleware('auth')->group(function () {

    // Common User Routes
    Route::get('/home', function () {
        $user = auth()->user();

        if ($user->type == 1)
        return redirect('admin');

        return view('user-dashboard/index', ['user' => $user]);
    });

    Route::get('/complete-registration', function () {
        $user = auth()->user();
        return view('user-dashboard/complete-registration', ['user' => $user]);
    });

    // Admin Routes
    Route::get('/admin', function () {
        $curr_user = auth()->user();
        $users = DB::table('users')->orderByDesc('created_at')->paginate(15);

        if ($curr_user->type != 1)
        return redirect('home');

        return view('admin-dashboard/index', ['users' => $users]);
    });

    Route::post('/new-user', [UserController::class, 'storeSite']);

    Route::put('/update', [UserController::class, 'updateSite']);
    Route::put('/update/{id}', [UserController::class, 'updateSite']);
    Route::delete('/{id}', [UserController::class, 'destroySite']);

    Route::get('/logout', [UserController::class, 'logoutSite']);
});
