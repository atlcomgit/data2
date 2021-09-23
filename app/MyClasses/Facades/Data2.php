<?php // фасад для config\app.php

namespace App\MyClasses\Facades;

use Illuminate\Support\Facades\Facade;

class Data2 extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'data2';
    }
}