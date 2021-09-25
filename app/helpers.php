<?php // register in: composer.json - autoload.files & terminal: composer dump

use Illuminate\Support\Facades\Request;
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
        return Request::is($name) ? $class : '';
    }
}

if (!function_exists('module_column')) {
    function module_column(string $column, $db): string
    {
        switch ($column) {
            case 'olnCityName':
                $column = $db->{"$column"};
                break;
            case 'olnAgencyName':
                $column = Str::substr($db->{"$column"}, 4, -1);
                break;
            case 'olnStatus':
                $column = '-';
                break;
            default:
                $column = $db->{"$column"};
        }
        return $column;
    }
}