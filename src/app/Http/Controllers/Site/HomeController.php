<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\View;

final class HomeController extends SiteController
{
    public function index()
    {
        $data = [];
        if (View::exists('layout.default.home.index')) {
            return view('layout.default.home.index', $this->render($data));
        } else {
            return redirect(admin_url())->withErrors('Please login admin select template');
        }
    }

}
