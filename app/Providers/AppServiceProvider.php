<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\facades\view;
use Illuminate\Support\facades\Schema;
use Illuminate\Support\Facades\Session;


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
        Paginator::useBootstrap();
        
        if (Schema::hasTable('categories')){
            view::share('categories', Category::orderBy('name')->get());
        }
        App::setLocale(session::get('locale', config('app.locale') ));      
    }
}
