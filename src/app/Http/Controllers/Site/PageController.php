<?php

namespace App\Http\Controllers\Site;

use App\Models\Page;
use Illuminate\Http\Request;

final class PageController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view(Request $request, $slug)
    {
        $page = Page::query()->where('slug', $slug)->first();

        if (empty($page)) {
            return redirect(base_url('404.html'));
        }

        $data = [
            'title' => $page->title,
            'page' => $page,
        ];

        return view($this->layout . 'page.view', $this->render($data));
    }

    public function notfound()
    {
        $data['title'] = 'notfound page';

        return view($this->layout . 'page.notfound', $this->render($data));
    }

    public function maintenance()
    {
        $data['title'] = trans('comment.maintenance');

        return view($this->layout . 'page.maintenance', $this->render($data));
    }

    public function resume()
    {
        $data = [];

        return view($this->layout . 'page.resume', $this->render($data));
    }
}
