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
        Artisan::call('migrate');
//        Artisan::call('storage:link');
//        Artisan::call('db:seed --class=RegionsTableSeeder');
//        Artisan::call('db:seed --class=UsersTableSeeder');
//        Artisan::call('vendor:publish --tag=flare-config');
//        Artisan::call('key:generate');
//        Artisan::call('cache:clear');
//        Artisan::call('view:clear');
//        Artisan::call('package:discover');
    }

    public function migrate()
    {
        Artisan::call('migrate');
    }
}
