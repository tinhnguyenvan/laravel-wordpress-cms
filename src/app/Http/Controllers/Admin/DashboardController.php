<?php
/**
 * @author: nguyentinh
 * @create: 06/20/20, 8:21 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Ads;
use App\Models\Comment;
use App\Models\Media;
use App\Models\Member;
use App\Models\Post;
use App\Models\QueueFailJob;
use App\Models\QueueJob;
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
        $totalQueueHandle =  QueueJob::query()->count();
        $totalQueueFailed =  QueueFailJob::query()->count();
        $totalQueue =  $totalQueueHandle + $totalQueueFailed;

        $data = [
            [
                'icon' => 'fa fa-newspaper-o',
                'total' => Post::query()->count(),
                'title' => trans('common.nav.post'),
                'link' => admin_url('posts'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-user',
                'total' => User::query()->count(),
                'title' => 'Account manager',
                'link' => admin_url('users'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-users',
                'total' => Member::query()->count(),
                'title' => trans('common.nav.user'),
                'link' => admin_url('members'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-file-o',
                'total' => Media::query()->count(),
                'title' => trans('common.nav.media'),
                'link' => admin_url('medias'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-comment-o',
                'total' => Comment::query()->count(),
                'title' => trans('common.nav.comment'),
                'link' => admin_url('comments'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-image',
                'total' => Ads::query()->count(),
                'title' => trans('common.nav.ads'),
                'link' => admin_url('ads'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-database',
                'total' => $totalQueueHandle,
                'title' => 'Queue Handle',
                'color' => '',
                'link' => 'javascript:void()',
                'percent' => $totalQueue > 0 ? round($totalQueueHandle * 100 / $totalQueue) : 0,
            ],
            [
                'icon' => 'fa fa-database',
                'total' => $totalQueueFailed,
                'title' => 'Queue Fail',
                'color' => 'danger',
                'link' => 'javascript:void()',
                'percent' => $totalQueue > 0 ? round($totalQueueFailed * 100 / $totalQueue) : 0,
            ],
        ];

        $data = [
            'data' => $data,
            'title' => 'Dashboard',
        ];

        return view('admin/dashboard.index', $this->render($data));
    }
}
