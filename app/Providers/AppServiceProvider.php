<?php

namespace App\Providers;

use App\Models\User;
use App\View\Components\loginButton;
use App\View\Components\SwitchButton;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

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
        //
        Paginator::useBootstrap();
        Blade::component('switch-button', SwitchButton::class);
        Blade::component('login-button', loginButton::class);
        Blade::if('isadmin', function (User $user) {
            return $user->settings->admin === 1;
        });
        Blade::if('ishidden',function (User $user){
            return $user->settings->hidden === 1;

        });
    }
}
