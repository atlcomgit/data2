<?php

namespace App\Http\Controllers;

use App\Models\Cis;
use App\Models\Web;
use App\MyClasses\Data2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index()
    {
        $_modules = [];

        foreach (data2()->config('modules') as $module => $title) $_modules[] = (object) [
            'name' => $module,
            'title' => __($title),
        ];

        return view('pages.modules.index', compact('_modules'));
    }

    public function show($module)
    {
        return view('pages.modules.show', [
            'status' => true,
            'module' => $module,
            'data' => $this->getData($module, 'web'),
        ]);
    }
    public static function getData($module, $route = 'web')
    {
        $data = [];

        switch ($module) {
            case 'online':
                if ($route == 'web') break;

                $data = DB::connection('sqlsrv_web')->select("
                SELECT * FROM WEB.dbo.Online
                    ORDER BY olnBye,
                        (CASE WHEN olnCityName='Томск' AND olnUserCode='33333333' THEN 1 ELSE 0 END),
                        olnCityName,olnAgencyName,olnUserName,olnIP                
                    ");
                break;
        }
        return $data;
    }
}