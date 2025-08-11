<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Authenticate::redirectUsing(function ($request) {
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->role === ADMIN_ROLE) {
                    return route('adb-login'); // Admin login form
                } else {
                    return route('show-login-form');
                }
            }

            if ($request->is('admin/*') || $request->is('adb-login')) {
                return route('adb-login'); // Admin login
            }

            return route('show-login-form'); // Normal user login
        });
    }
}
