<?php
namespace Authenticator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravel\Passport\Passport;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        Passport::routes(function ($router) {
            $router->forAccessTokens();
        });
        Passport::tokensExpireIn((new Carbon())->addDays(1));
        Passport::refreshTokensExpireIn((new Carbon())->addDays(3));
    }
    public function register()
    {
        //Passport::ignoreMigrations();
        Route::group([
            'namespace' => 'Authenticator\Controllers',
            'as' => 'authenticator.',
            'prefix' => '' // auth-center
        ], function () {
            include(__DIR__ . '/Routes.php');
        });
    }
}
