<?php

namespace App\Providers;

use App\View\Components\StarRating;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;

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
        Blade::component('x-dropdown', \WireUi\View\Components\Dropdown::class);

        Blade::component('star-rating', StarRating::class);
        RateLimiter::for('reviews', function (Request $request) {

            return Limit::perHour(3)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
