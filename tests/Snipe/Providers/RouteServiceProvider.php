<?php

namespace Deelbaarmechelen\DeelIt\Tests\Snipe\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Deelbaarmechelen\DeelIt\Tests\Snipe\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
    }


    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
//            'middleware' => 'auth:api',
            'middleware' => 'deelit',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
//            require base_path('routes/api.php');
            require __DIR__.'/../routes/api.php';
        });
    }
}
