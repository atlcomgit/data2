<?php
//terminal: php artisan make:provider Data2ServiceProvider

namespace App\Providers;

use App\MyClasses\Data2;
use Illuminate\Support\ServiceProvider;

class Data2ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('data2', function () {
            return new Data2(config('data2'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}