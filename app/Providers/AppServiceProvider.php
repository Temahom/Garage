<?php

namespace App\Providers;
use App\Models\User;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Gate::define('admin',function(User $user){
        return $user->isAdmin();
        });
        Gate::define('raf', function(User $user){
        return $user->isRaf();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        //
        view()->composer('layouts.master', function ($view) {

            $theme = \Cookie::get('theme');
        
            if ($theme != 'dark-theme' && $theme != 'light') {
        
                $theme = 'light';
        
            }
        
            $view->with('theme', $theme);
        
        });
        
    }
}
