<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ads;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Media;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Product;
use App\Models\RolePermission;
use App\Models\SaleOrder;
use App\Models\User;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:'.RolePermission::DASHBOARD_SHOW]);
    }

    public function index()
    {
        $data = [
            [
                'icon' => 'fa fa-newspaper-o',
                'total' => Post::query()->count(),
                'title' => trans('common.nav.post'),
                'link' => admin_url('posts'),
            ],
            [
                'icon' => 'fa fa-users',
                'total' => User::query()->count(),
                'title' => trans('common.nav.user'),
                'link' => admin_url('users'),
            ],
            [
                'icon' => 'fa fa-tags',
                'total' => PostTag::query()->count(),
                'title' => trans('common.nav.tag'),
                'link' => admin_url('tags'),
            ],
            [
                'icon' => 'fa fa-file-o',
                'total' => Media::query()->count(),
                'title' => trans('common.nav.media'),
                'link' => admin_url('medias'),
            ],
            [
                'icon' => 'fa fa-comment-o',
                'total' => Comment::query()->count(),
                'title' => trans('common.nav.comment'),
                'link' => admin_url('comments'),
            ],
            [
                'icon' => 'fa fa-cube',
                'total' => Product::query()->count(),
                'title' => trans('common.nav.product'),
                'link' => admin_url('products'),
            ],
            [
                'icon' => 'fa fa-image',
                'total' => Ads::query()->count(),
                'title' => trans('common.nav.ads'),
                'link' => admin_url('ads'),
            ],
            [
                'icon' => 'fa fa-support',
                'total' => Contact::query()->count(),
                'title' => trans('common.nav.contact'),
                'link' => admin_url('contacts'),
            ],
            [
                'icon' => 'nav-icon fa fa-shopping-cart',
                'total' => SaleOrder::query()->count(),
                'title' => trans('common.nav.cart'),
                'link' => admin_url('orders'),
            ],
        ];

        $data = [
            'data' => $data,
            'title' => 'Dashboard',
        ];

        return view('admin/dashboard.index', $this->render($data));
    }
}
