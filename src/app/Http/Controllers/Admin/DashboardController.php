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
        $totalQueueHandle = QueueJob::query()->count();
        $totalQueueFailed = QueueFailJob::query()->count();
        $totalQueue = $totalQueueHandle + $totalQueueFailed;

        $countPost = cache()->remember(
            'dashboard_count_post',
            300,
            function (): int {
                return Post::query()->count();
            }
        );

        $countUser = cache()->remember(
            'dashboard_count_user',
            300,
            function (): int {
                return User::query()->count();
            }
        );

        $countMember = cache()->remember(
            'dashboard_count_member',
            300,
            function (): int {
                return Member::query()->count();
            }
        );

        $countMedia = cache()->remember(
            'dashboard_count_media',
            300,
            function (): int {
                return Media::query()->count();
            }
        );

        $countComment = cache()->remember(
            'dashboard_count_comment',
            300,
            function (): int {
                return Comment::query()->count();
            }
        );

        $countAds = cache()->remember(
            'dashboard_count_ads',
            300,
            function (): int {
                return Ads::query()->count();
            }
        );

        $data = [
            [
                'icon' => 'fa fa-newspaper-o',
                'total' => $countPost,
                'title' => trans('common.nav.post'),
                'link' => admin_url('posts'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-user',
                'total' => $countUser,
                'title' => 'Account manager',
                'link' => admin_url('users'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-users',
                'total' => $countMember,
                'title' => trans('common.nav.user'),
                'link' => admin_url('members'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-file-o',
                'total' => $countMedia,
                'title' => trans('common.nav.media'),
                'link' => admin_url('medias'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-comment-o',
                'total' => $countComment,
                'title' => trans('common.nav.comment'),
                'link' => admin_url('comments'),
                'percent' => 100,
            ],
            [
                'icon' => 'fa fa-image',
                'total' => $countAds,
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
