<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CulturalColumnController;
use App\Models\Category;
use App\Models\CulturalColumn;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/find-professionals', function (Request $request) {
    $curr_user = auth()->user();

    $search_param = $request->query('s');
    if (!is_null($search_param)) {
        $users = User::paginate(15)->where("name", "like", "%$search_param");
        /* $users = DB::table('users') */
        /* ->join('activities', 'users.id', '=', 'activities.user_id') */
        /* ->select('users.*', 'activities.title') */
        /* ->where("name", 'like', "%$search_param%")->orderByDesc('created_at')->paginate(15); */
    } else {
        $users = User::paginate(15);
        /* $users = DB::table('users') */
        /* ->join('activities', 'users.id', '=', 'activities.user_id') */
        /* ->select('users.*', 'activities.title') */
        /* ->orderByDesc('created_at')->paginate(15); */
    }

    return view('profissionais', ['professionals' => $users]);
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

    Route::get('/profile-setup', function () {
        $user = auth()->user();

        if ($user->type == 1)
        return redirect('admin');

        return view('user-dashboard/profile-setup', [
            'user' => $user,
            'categories' => Category::all()
        ]);
    });

    // Admin Routes
    Route::get('/admin', function (Request $request) {
        $curr_user = auth()->user();

        $search_param = $request->query('s');
        if (!is_null($search_param)) {
            $users = DB::table('users')->where("name", 'like', "%$search_param%")->orderByDesc('created_at')->paginate(15);
        } else {
            $users = DB::table('users')->orderByDesc('created_at')->paginate(15);
        }

        if ($curr_user->type != 1)
        return redirect('home');

        return view('admin-dashboard/index', ['users' => $users]);
    });

    Route::get('/posts', function(Request $request) {
        $search_param = $request->query('s');
        if (!is_null($search_param)) {
            $posts = CulturalColumn::paginate(15)->where("title", "like", "%$search_param%");
        } else {
            $posts = CulturalColumn::paginate(15);
        }
        return view('admin-dashboard.posts.index', ['posts' => $posts]);
    });

    Route::get('/new-user', [UserController::class, 'create']);
    Route::post('/new-user', [UserController::class, 'storeSite']);

    Route::get('/new-post', [CulturalColumnController::class, 'create']);
    Route::post('/new-post', [CulturalColumnController::class, 'storeSite']);

    Route::get('/edit-user/{id}', [UserController::class, 'edit']);
    Route::put('/update', [UserController::class, 'updateSite']);
    Route::put('/update/{id}', [UserController::class, 'updateSite']);
    Route::delete('/{id}', [UserController::class, 'destroySite']);
    Route::delete('/user-gallery/{pic_id}', [UserController::class, 'deleteUserPicture']);
    Route::delete('/user-category/{category_id}', [UserController::class, 'deleteUserCategory']);

    Route::get('/logout', [UserController::class, 'logoutSite']);
});
