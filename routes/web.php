<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminSystemController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Admin\AdminPostCategoryController;
use App\Http\Controllers\Dashboard\DashboardPostController;
use App\Http\Controllers\Admin\AdminPostsCategoryController;
use App\Http\Controllers\Dashboard\DashboardProfileController;
use App\Http\Controllers\Admin\AdminOrganizationHistoryController;
use App\Http\Controllers\Dashboard\DashboardOrganizationHistoryController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/post/{slug}', [PostController::class, 'post'])->name('post');
Route::get('/@{username}', [UserPageController::class, 'user'])->name('user.page');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::fallback(function () {
    return redirect()->route('home');
});

Route::middleware('verified')->group(function () {
    Route::post('/comments', [CommentController::class, 'commentStore'])->name('comment.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'commentDestroy'])->name('comment.destroy');
    Route::patch('/comments/{comment}', [CommentController::class, 'commentUpdate'])->name('comment.update');
    Route::patch('/comments/{comment}/report', [CommentController::class, 'commentReport'])->name('comment.report');
    Route::patch('/comments/{comment}/marknotspam', [CommentController::class, 'commentMarkNotSpam'])->name('comment.markasnotspam');
});

Route::middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::prefix('admin')->group(function () {

        Route::resource('/users', AdminUserController::class, ['as' => 'admin']);
        Route::post('/users/{user}/make-superadmin', [AdminUserController::class, 'makeSuperAdmin'])->name('admin.users.makesuperadmin');
        Route::post('/users/{user}/remove-superadmin', [AdminUserController::class, 'removeSuperAdmin'])->name('admin.users.removesuperadmin');
        Route::post('/users/{user}/make-admin', [AdminUserController::class, 'makeAdmin'])->name('admin.users.makeadmin');
        Route::post('/users/{user}/remove-admin', [AdminUserController::class, 'removeAdmin'])->name('admin.users.removeadmin');
        Route::post('/users/{user}/verify', [AdminUserController::class, 'verify'])->name('admin.users.verify');
        Route::post('/users/{user}/unverify', [AdminUserController::class, 'unverify'])->name('admin.users.unverify');
        Route::post('/users/{user}/reset-password', [AdminUserController::class, 'resetPassword'])->name('admin.users.resetpassword');

        Route::get('/systems', [AdminSystemController::class, 'index'])->name('admin.systems.index');
        Route::post('/systems/{system}/enable', [AdminSystemController::class, 'enable'])->name('admin.systems.enable');
        Route::post('/systems/{system}/disable', [AdminSystemController::class, 'disable'])->name('admin.systems.disable');

        Route::resource('/organization-histories', AdminOrganizationHistoryController::class, ['as' => 'admin']);
        Route::post('/organization-histories/{organization_history}/approve', [AdminOrganizationHistoryController::class, 'approve'])
            ->name('admin.organization_histories.approve');
        Route::post('/organization-histories/{organization_history}/unapprove', [AdminOrganizationHistoryController::class, 'unapprove'])
            ->name('admin.organization_histories.unapprove');

        Route::resource('/post-categories', AdminPostCategoryController::class, ['as' => 'admin']);

        Route::get('/posts', function () {
            return view('admin.posts.index');
        })->name('admin.posts.index');
    });
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('dashboard')->middleware('verified_account')->group(function () {
        Route::resource('/posts', DashboardPostController::class, ['as' => 'dashboard']);
        Route::resource('/organization-histories', DashboardOrganizationHistoryController::class, ['as' => 'dashboard']);
        Route::post('/organization-histories/{organization_history}/request', [DashboardOrganizationHistoryController::class, 'request'])
            ->name('dashboard.organization_histories.request');
        Route::post('/organization-histories/{organization_history}/active', [DashboardOrganizationHistoryController::class, 'active'])
            ->name('dashboard.organization_histories.active');
        Route::post('/organization-histories/{organization_history}/unactive', [DashboardOrganizationHistoryController::class, 'unactive'])
            ->name('dashboard.organization_histories.unactive');
    });

    Route::get('/profile', [DashboardProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [DashboardProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [DashboardProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
