<?php

namespace Core;

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
        $this->mapCoreRoutes();
        //
    }

    protected function mapCoreRoutes(){
        Route::middleware(['json.response', 'client'])
            ->namespace('Core\Controllers')
            ->as('api.core.')
            ->prefix('api/core')
            ->group(base_path('modules/core/Routes.php'));
    }
}
