<?php

namespace Imgenerate\LaravelFaker;

use Illuminate\Support\ServiceProvider;

class ImgenerateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/imgenerate.php' => config_path('imgenerate.php'),
            ], 'imgenerate-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Merge configuration
        $this->mergeConfigFrom(__DIR__.'/../config/imgenerate.php', 'imgenerate');

        // Register the main class to use with the facade
        $this->app->singleton('imgenerate', function ($app) {
            return new ImgenerateService();
        });
    }
}

