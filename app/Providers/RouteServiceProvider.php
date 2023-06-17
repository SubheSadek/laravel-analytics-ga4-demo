<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    private $routeLists = [
        [
            'directory' => 'Admin', //root
            'middleware' => 'web',
            'prefix' => 'admin',
        ],
    ];

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {

            foreach ($this->routeLists as $r) {
                $path = base_path('/app/Http/Controllers/'.$r['directory'].'/*');
                foreach (glob($path) as $m) {
                    if (file_exists("$m/routes.php")) {
                        Route::middleware($r['middleware'])
                            ->namespace($this->namespace)
                            ->prefix($r['prefix'])
                            ->group("$m/routes.php");
                    }
                }
            }

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
