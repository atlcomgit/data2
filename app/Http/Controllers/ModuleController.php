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
            'ip' => request()->ip(),
            'data' => $this->getData($module, 'web'),
        ]);
    }

    public static function getData($module, $sid = null, $route = 'web')
    {
        $_data = [];

        switch ($module) {
            case 'online':
                if ($route == 'web') break;

                if ($sid === null) {
                    $_dbs = DB::connection('sqlsrv_web')->select("
                    SELECT * FROM WEB.dbo.Online
                        ORDER BY olnBye,
                            (CASE WHEN olnCityName='Томск' AND olnUserCode='33333333' THEN 1 ELSE 0 END),
                            olnCityName,olnAgencyName,olnUserName,olnIP                
                        ");
                    foreach ($_dbs as $_db) $_data[] = (object) [
                        'sid' => module_id($module, $_db),
                        'class' => module_class($module, $_db),
                        'city' => module_column('olnCityName', $_db),
                        'agency' => module_column('olnAgencyName', $_db),
                        'status' => module_column('olnStatus', $_db),
                    ];
                } else {
                    $_data = DB::connection('sqlsrv_web')->selectOne("
                    SELECT TOP 1 * FROM WEB.dbo.Online
                        WHERE LOWER(CONVERT(VARCHAR(32),HASHBYTES('MD5',olnCityCode+olnUserCode+olnUserASN+olnUserPhone+olnIP),2))='$sid'
                        ");
                }
                break;
        }
        return $_data;
    }
}