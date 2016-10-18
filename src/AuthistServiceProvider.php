<?php

namespace Authist;

use Illuminate\Support\ServiceProvider;

class AuthistServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'authist');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'authist');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/authist'),
            ], 'authist-views');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'authist-migrations');

            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/authist'),
            ], 'authist-locale');
        }
    }

    public function register()
    {
        //
    }
}