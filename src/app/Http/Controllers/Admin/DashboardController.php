<?php
/**
 * @author: nguyentinh
 * @create: 06/20/20, 8:21 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Ads;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Media;
use App\Models\Member;
use App\Models\Post;
use App\Models\RolePermission;
use App\Models\User;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::DASHBOARD_SHOW]);
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
                'icon' => 'fa fa-user',
                'total' => User::query()->count(),
                'title' => 'Account manager',
                'link' => admin_url('users'),
            ],
            [
                'icon' => 'fa fa-users',
                'total' => Member::query()->count(),
                'title' => trans('common.nav.user'),
                'link' => admin_url('members'),
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
        ];

        $data = [
            'data' => $data,
            'title' => 'Dashboard',
        ];

        return view('admin/dashboard.index', $this->render($data));
    }
}
