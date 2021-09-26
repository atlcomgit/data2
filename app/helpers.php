<?php // register in: composer.json - autoload.files & terminal: composer dump

include_once "strings.php";
include_once "dates.php";

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

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

if (!function_exists('module_class')) {
    function module_class(string $module, $db): string
    {
        switch ($module) {
            case 'online':
                if ($db->olnCityCode . $db->olnUserCode == '382233333333') $class = "text-black-50";
                else if ($db->olnUserCode != '' && $db->olnTermTo < App\Dates::today()) $class = "bg-danger text-white";
                else if ($db->olnDolg) $class = "bg-info text-white";
                else if ($db->olnFree) $class = "bg-secondary text-white";
                else if ($db->olnLocal) $class = "";
                else $class = '';
                break;
            default:
                $class = "";
        }
        return $class;
    }
}
if (!function_exists('module_column')) {
    function module_column(string $column, $db): string
    {
        switch ($column) {
            case 'olnCityName':
                $value = $db->{"$column"};
                break;
            case 'olnAgencyName':
                $value = Str::substr($db->{"$column"}, 4, -1);
                break;
            case 'olnStatus':
                if ($db->olnUserCode != '' && $db->olnTermTo < date('Y.m.d')) {
                    $term = ($db->olnTermTo != '') ? (int) App\Dates::differDates2days(App\Dates::today(), $db->olnTermTo) : '';
                    $value = "$term дн."; //$value = "Отключено";
                } else if ($db->olnDolg) $value = "ДОЛГ";
                else if ($db->olnFree) $value = "БЕСПЛАТНО";
                else if ($db->olnLocal) $value = "Local";
                else $value = '';
                break;
            default:
                $value = $db->{"$column"};
        }
        return $value;
    }
}