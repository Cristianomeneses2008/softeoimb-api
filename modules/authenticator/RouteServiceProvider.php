<?php

namespace Authenticator;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
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
        $this->mapAuthRoutes();
        //
    }

    protected function mapAuthRoutes(){
        Route::middleware(['json.response'])
            ->namespace('Authenticator\Controllers')
            ->as('auth.core.')
            ->prefix('auth/core')
            ->group(base_path('modules/authenticator/Routes.php'));
    }
}
