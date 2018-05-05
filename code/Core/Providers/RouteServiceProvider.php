<?php

namespace Code\Core\Providers;

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
    protected $namespace = 'Code\Core\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->registerMiddlewares();
    }

    /**
     * Registers the necessary middlewares
     */
    protected function registerMiddlewares()
    {
        Route::aliasMiddleware('auth.jwt',  \Code\Auth\Http\Middleware\AuthenticateUsingJwt::class);
    }
}