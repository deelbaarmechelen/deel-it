<?php

namespace Deelbaarmechelen\DeelIt;

use Deelbaarmechelen\DeelIt\Http\Middleware\GenerateAssetTag;
use Deelbaarmechelen\DeelIt\Observers\AssetObserver;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class DeelItServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'deel-it');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'deel-it');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // register middleware alias
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('generate_asset_tag', GenerateAssetTag::class);
        $router->pushMiddlewareToGroup('deelit', GenerateAssetTag::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('deel-it.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/deel-it'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/deel-it'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/deel-it'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);

            // Export the migration
            if (! class_exists('AssetTagPattern')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_asset_tag_pattern_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_asset_tag_pattern_table.php'),
                ], 'migrations');
            }

            // Register the model factories
            // Disabling, requires Faker/Factory class which is only available in dev mode
            //$this->app->make('Illuminate\Database\Eloquent\Factory')
            //    ->load(__DIR__ . '/../database/factories');
        }

        // Register observers
        $className = 'App\\Models\\Asset';
        if (class_exists ($className)) {
            \Log::debug($className . " exists -> registering observer for update of sequence numbers");
            //\App\Models\Asset::observe(AssetObserver::class);
            $className::observe(AssetObserver::class);
        } else {
            \Log::error($className . " does not exist -> no observer could be attached, sequence numbers won't be updated !!!");
        }

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'deel-it');

        // Register the main class to use with the facade
        $this->app->singleton('deel-it', function () {
            return new DeelIt;
        });
    }
}
