<?php

namespace Code\Core\Providers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\View;
use Code\Core\Exceptions\Handler;
use Illuminate\Support\ServiceProvider;
use Prettus\Repository\Providers\RepositoryServiceProvider;
//use Mpociot\ApiDoc\ApiDocGeneratorServiceProvider;


class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__."../database/migrations");
        /**
         * Overriding Laravel's Core Exception Handler
         * by our own Exception Handler
         */
        $this->app->bind(
            ExceptionHandler::class,
            Handler::class
        );

    }

    /**
     * Register's application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();

        $this->app->register('Code\Core\Providers\RouteServiceProvider');
        $this->app->register('Code\Core\Providers\AuthServiceProvider');

        //Load the other modules
        //$this->app->register('Code\Auth\Providers\AuthServiceProvider');
    }

    /**
     * Register app providers
     */
    private function registerProviders(){
        $providers = config('app.providers');
        //Set your providers here or in config/app.php
        array_push($providers, RepositoryServiceProvider::class);

        config(["app.providers" => $providers]);

    }

}