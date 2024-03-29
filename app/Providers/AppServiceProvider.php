<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        View::share('category', Category::withCount('product')->get());
        //  View::share('cart', Cart::where('user_id', auth()->id())->get());

        View::composer('*', function ($view) {
            $view->with('cart', Cart::where('user_id', auth()->id())->get());
        });
        Paginator::useBootstrapFour();
    }
}
