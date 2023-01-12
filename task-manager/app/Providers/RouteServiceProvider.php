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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {

        $this->configureRateLimiting();



            $this->routes(function () {

                /**
                 * Route for Users
                 */
                Route::middleware('api')
                    ->prefix('users')
                    ->group(base_path('routes/user/routes.php'));
                /**
                 * Route for teams
                 */
                Route::middleware('api')
                    ->prefix('teams')
                    ->group(base_path('routes/team/routes.php'));

                /**
                 * Route for Project
                 */
                Route::middleware('api')
                    ->prefix('projects')
                    ->group(base_path('routes/project/routes.php'));

                /**
                 * Route for Task
                 */
                Route::middleware('api')
                    ->prefix('tasks')
                    ->group(base_path('routes/task/routes.php'));

                /**
                 * Route for Auth
                 */
                Route::middleware('api')
                    ->prefix('auth')
                    ->group(base_path('routes/auth/routes.php'));


                Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('routes/api.php'));

                Route::middleware('web')
                    ->group(base_path('routes/web.php'));
            });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

}
