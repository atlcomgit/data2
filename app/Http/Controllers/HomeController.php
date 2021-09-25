<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (auth('web')->check()) return redirect()->route('pages.modules');

        return view('pages.home.index');
    }
}