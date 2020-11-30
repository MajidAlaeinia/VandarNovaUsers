<?php

namespace majidalaeinia\VandarNovaUsers;

use Illuminate\Support\ServiceProvider;
use majidalaeinia\VandarNovaUsers\Console\Commands\ImportVandarNovaUsersCommand;

class VandarNovaUsersServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'majidalaeinia');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'majidalaeinia');
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
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/vandarnovausers.php', 'vandarnovausers');

        // Register the service the package provides.
        $this->app->singleton('vandarnovausers', function ($app) {
            return new VandarNovaUsers;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['vandarnovausers'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/vandarnovausers.php' => config_path('vandarnovausers.php'),
        ], 'vandarnovausers.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/majidalaeinia'),
        ], 'vandarnovausers.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/majidalaeinia'),
        ], 'vandarnovausers.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/majidalaeinia'),
        ], 'vandarnovausers.views');*/

        // Registering package commands.
         $this->commands([
              ImportVandarNovaUsersCommand::class
         ]);
    }
}
