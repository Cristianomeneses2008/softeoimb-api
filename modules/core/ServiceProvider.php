<?php
namespace Core;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'core');
    }
    public function register()
    {
        //include(__DIR__ . '/Routes.php');
    }
}
