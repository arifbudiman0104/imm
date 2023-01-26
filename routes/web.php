<?php

use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/posts', function () {
    return view('posts');
})->name('posts');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::fallback(function () {
    return redirect()->route('home');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin');

    Route::prefix('admin')->group(function () {
        Route::get('/users', function () {
            return view('admin.users.index');
        })->name('admin.users.index');
        Route::get('/posts-categories', function () {
            return view('admin.posts-categories.index');
        })->name('admin.posts-categories.index');
        Route::get('/posts', function () {
            return view('admin.posts.index');
        })->name('admin.posts.index');
    });
});
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::get('/posts', function () {
            return view('dashboard.posts.index');
        })->name('dashboard.posts.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
