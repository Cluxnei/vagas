<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
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
        date_default_timezone_set('America/Sao_Paulo');
        Schema::defaultStringLength(255);
        // Gate to manage cities, users, jobs, companies, etc...
        Gate::define('manage', function ($user) {
            return $user->isAdministrator();
        });
        Gate::define('no-manage', function ($user) {
            return !$user->isAdministrator();
        });
    }
}
