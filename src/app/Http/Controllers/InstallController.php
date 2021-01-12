<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InstallController extends Controller
{
    public function index()
    {
        return view('site.install.index');
    }

    public function install(Request $request)
    {
        $params = $request->all();
        Artisan::call('install');
    }
}
