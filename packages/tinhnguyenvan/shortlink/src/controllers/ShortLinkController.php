<?php

namespace TinhNguyenVan\ShortLink\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TinhNguyenVan\ShortLink\Models\ShortLink;

class ShortLinkController extends Controller
{
    public function index()
    {
        $items = [];

        return view('views::short_link.list', compact('items'));
    }

    public function create()
    {
        return view('views::short_link.form');
    }

    public function store()
    {
        $input = Request::all();
        ShortLink::query()->create($input);

        return redirect()->route('short_link.create');
    }

    public function edit($id)
    {
        $items = ShortLink::all();
        $item = $items->find($id);

        return view('views::short_link.form', compact('items', 'item'));
    }

    public function update($id)
    {
        $input = Request::all();
        $task = ShortLink::query()->findOrFail($id);
        $task->update($input);

        return redirect()->route('short_link.create');
    }

    public function destroy($id)
    {
        $task = ShortLink::query()->findOrFail($id);
        $task->delete();

        return redirect()->route('short_link.create');
    }
}
