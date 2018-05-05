<?php

namespace Code\Auth\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Code\Auth\Services\Auth\JwtGuard;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Register the custom guard
        Auth::extend('jwt', function ($app, $name, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\Guard...
            return new JwtGuard(Auth::createUserProvider($config['provider']));
        });
    }

    /**
     * Register's application policies.
     *
     * @return void
     */
    public function registerPolicies(){

    }

    /**
     * Register's application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Code\Auth\Providers\RouteServiceProvider');
        $this->registerAuthConfig();

        //View::addLocation(realpath(__DIR__.'/../resources/views'));

    }

    /**
     * Define auth config
     */
    public function registerAuthConfig(){

        $config = $this->app['config']['auth'];

        //$config['defaults']['guard'] = 'api-user1';

        $config['guards']['api-user1'] = [
            'driver'   => 'jwt', //See line 22
            'provider' => 'custom-provider',
        ];

        $config['providers']['custom-provider'] = [
            'driver' => 'eloquent',
            //'model'  => \Code\Chef\Model\Chef::class, //Change to appropriate model and uncomment
        ];

        $this->app['config']['auth'] = $config;

    }

}
