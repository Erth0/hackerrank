<?php

namespace Mukja\HackerRank;

use Illuminate\Support\ServiceProvider;

class HackerRankServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mukja');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'mukja');
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
        $this->mergeConfigFrom(__DIR__.'/../config/hackerrank.php', 'hackerrank');

        // Register the service the package provides.
        $this->app->singleton('hackerrank', function ($app) {
            return new HackerRank;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['hackerrank'];
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
            __DIR__.'/../config/hackerrank.php' => config_path('hackerrank.php'),
        ], 'hackerrank.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/mukja'),
        ], 'hackerrank.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/mukja'),
        ], 'hackerrank.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/mukja'),
        ], 'hackerrank.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
