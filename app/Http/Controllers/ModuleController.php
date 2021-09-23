<?php

namespace App\Http\Controllers;

use App\MyClasses\Data2;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $_modules = [];

        foreach (data2()->config('modules') as $module => $title) $_modules[] = (object) [
            'name' => $module,
            'title' => __($title),
        ];

        return view('modules.index', compact('_modules'));
    }

    public function show($module)
    {
        return view('modules.show', ['module' => $module,]);
    }
}