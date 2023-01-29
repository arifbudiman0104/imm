<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminUserController;

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

Route::get('/home', [PublicController::class, 'home'])->name('home');
Route::get('/posts', [PublicController::class, 'posts'])->name('posts');
Route::get('/posts/{slug}', [PublicController::class, 'post'])->name('post');
Route::post('/comments-store', [PublicController::class, 'commentStore'])->name('comment.store');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::fallback(function () {
    return redirect()->route('home');
});

// route any/any fallback to home
// Route::any('{any}', function () {
//     return redirect()->route('home');
// })->where('any', '.*');


Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin');

    Route::prefix('admin')->group(function () {
        Route::resource('/users', AdminUserController::class, ['as' => 'admin']);
        Route::post('/users/{user}/make-superadmin', [AdminUserController::class, 'makeSuperAdmin'])->name('admin.users.makesuperadmin');
        Route::post('/users/{user}/remove-superadmin', [AdminUserController::class, 'removeSuperAdmin'])->name('admin.users.removesuperadmin');
        Route::post('/users/{user}/make-admin', [AdminUserController::class, 'makeAdmin'])->name('admin.users.makeadmin');
        Route::post('/users/{user}/remove-admin', [AdminUserController::class, 'removeAdmin'])->name('admin.users.removeadmin');
        Route::post('/users/{user}/verify', [AdminUserController::class, 'verify'])->name('admin.users.verify');
        Route::post('/users/{user}/unverify', [AdminUserController::class, 'unverify'])->name('admin.users.unverify');

        Route::get('/posts-categories', function () {
            return view('admin.posts-categories.index');
        })->name('admin.posts-categories.index');
        Route::get('/posts', function () {
            return view('admin.posts.index');
        })->name('admin.posts.index');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('dashboard')->middleware('verified_account')->group(function () {
        Route::get('/posts', function () {
            return view('dashboard.posts.index');
        })->name('dashboard.posts.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
