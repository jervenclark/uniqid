<?php

namespace Jervenclark\Uniqid;

use Illuminate\Support\ServiceProvider;

class UniqidServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'jervenclark');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'jervenclark');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/uniqid.php', 'uniqid');

        // Register the service the package provides.
        $this->app->singleton('uniqid', function ($app) {
            return new Uniqid;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['uniqid'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/uniqid.php' => config_path('uniqid.php'),
        ], 'uniqid.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/jervenclark'),
        ], 'uniqid.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/jervenclark'),
        ], 'uniqid.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/jervenclark'),
        ], 'uniqid.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
