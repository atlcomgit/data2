<?php // register in: composer.json - autoload.files & terminal: composer dump

use Illuminate\Support\Facades\Route;

if (!function_exists('data2')) {
    function data2()
    {
        return app('data2');
    }
}

if (!function_exists('active_link')) {
    function active_link(string $name, $class = 'active'): string
    {
        return Route::is($name) ? $class : '';
    }
}