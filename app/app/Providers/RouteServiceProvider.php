<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot()
    {
        $this->configureRateLimiting();

        // $this->routes(function () {
        //     Route::middleware('api')
        //         // ->prefix('api/v1')
        //         ->group(base_path('routes/api.php'));

        // });

        $this->routes(function () {
            Route::middleware(['api'])
                ->as('api:')
                ->group(
                    base_path('routes/api.php')
                );
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    // protected function configureRateLimiting()
    // {
    //     RateLimiter::for('api', function (Request $request) {
    //         return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
    //     });
    // }

    protected function configureRateLimiting() : void
    {
        RateLimiter::for(
            name: 'api',
            callback: static fn (Request $request) : Limit => Limit::perMinute(
                maxAttempts: 60,
            )->by(
                key: $request->user()?->id ?: $request->ip(),
            ),
        );
    }
}
