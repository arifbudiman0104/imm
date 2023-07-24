<?php

namespace App\Providers;

use App\Models\User;
use App\Models\System;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', function (User $user) {
            return $user->is_admin == 1;
        });
        Gate::define('verified_account', function (User $user) {
            return $user->is_verified == 1;
        });
        Gate::define('superadmin', function (User $user) {
            return $user->is_superadmin == 1;
        });
        Gate::define('have_page', function (User $user) {
            return $user->username != null && $user->is_verified;
        });
        // disable this before seeding and enable it again after seeding
        View::share('register', System::where('name', 'Register')->first());
    }
}
