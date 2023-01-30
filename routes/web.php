<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminSystemController;

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
Route::get('/post/{slug}', [PublicController::class, 'post'])->name('post');
Route::post('/comments', [PublicController::class, 'commentStore'])->name('comment.store');
Route::delete('/comments/{comment}', [PublicController::class, 'commentDestroy'])->name('comment.destroy');
Route::patch('/comments/{comment}', [PublicController::class, 'commentUpdate'])->name('comment.update');
Route::patch('/comments/{comment}/report', [PublicController::class, 'commentReport'])->name('comment.report');
Route::patch('/comments/{comment}/marknotspam', [PublicController::class, 'commentMarkNotSpam'])->name('comment.markasnotspam');
Route::get('/user/{username}', [PublicController::class, 'user'])->name('user.page');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::fallback(function () {
    return redirect()->route('home');
});

Route::middleware(['auth', 'admin'])->group(function () {
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
        Route::get('/systems', [AdminSystemController::class, 'index'])->name('admin.systems.index');
        Route::post('/systems/{system}/enable', [AdminSystemController::class, 'enable'])->name('admin.systems.enable');
        Route::post('/systems/{system}/disable', [AdminSystemController::class, 'disable'])->name('admin.systems.disable');

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

require __DIR__ . '/auth.php';
