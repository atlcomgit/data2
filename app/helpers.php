<?php // register in: composer.json - autoload.files & terminal: composer dump

include_once "strings.php";
include_once "dates.php";
//include_once "files.php";

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


if (!function_exists('module_id')) {
    function module_id(string $module, $_db)
    {
        switch ($module) {
            case 'online':
                $id = md5("{$_db->olnCityCode}{$_db->olnUserCode}{$_db->olnUserASN}{$_db->olnUserPhone}{$_db->olnIP}");
                break;
            default:
                $id = null;
        }
        return $id;
    }
}

if (!function_exists('module_class')) {
    function module_class(string $module, $_db)
    {
        switch ($module) {
            case 'online':
                if ($_db->olnBye) $class = "bg-secondary";
                else if ($_db->olnCityCode . $_db->olnUserCode == '382233333333') $class = "text-black-50";
                else if ($_db->olnUserCode != '' && $_db->olnTermTo < App\Dates::today()) $class = "bg-danger text-white";
                else if ($_db->olnDolg) $class = "text-primary";
                else if ($_db->olnFree) $class = "bg-info";
                else if ($_db->olnLocal) $class = "";
                else $class = null;
                break;
            default:
                $class = null;
        }
        return $class;
    }
}

if (!function_exists('module_column')) {
    function module_column(string $column, $_db)
    {
        switch ($column) {
            case 'olnCityName':
                $value = $_db->{"$column"};
                break;
            case 'olnAgencyName':
                $value = Str::substr($_db->{"$column"}, 4, -1);
                break;
            case 'olnStatus':
                if ($_db->olnDolg) $value = "Долг";
                else if (in_array($_db->olnUserCode, ['22222222', '33333333'])) $value = 'Work';
                else if ($_db->olnFree) $value = "Free";
                else if ($_db->olnUserCode != '' /*&& $_db->olnTermTo != '' && $_db->olnTermTo < date('Y.m.d')*/) {
                    $term = ($_db->olnTermTo != '') ? (int) App\Dates::differDates2days(App\Dates::today(), $_db->olnTermTo) : '';
                    $value = ($term === '' || $term < -365) ? null : "$term дн.";
                } else $value = null;
                break;
            default:
                $value = $db->{"$column"};
        }
        return $value;
    }
}