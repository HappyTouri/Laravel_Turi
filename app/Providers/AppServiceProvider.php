<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\PersonalAccessToken;
use Log;

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


        // // Define the rate limiter for the API
        // RateLimiter::for('api', function (Request $request) {
        //     return Limit::perMinute(60); // Adjust the limit as needed
        // });

        // // Specify the custom Personal Access Token model for Sanctum
        // // Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        // // Use Bootstrap styling for pagination links
        // Paginator::useBootstrap();
    }
}
