<?php
/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Jobs\UserJob;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class UserController.
 */
final class UserController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function activeMail(Request $request)
    {
        $params = $request->only(['email', 'code']);
        $condition = [
            'email' => $params['email'],
            'status' => User::STATUS_WAITING_ACTIVE,
        ];

        $user = User::query()->where($condition)->first();

        if (!empty($user->id)) {
            $user->status = User::STATUS_ACTIVE;
            $user->updated_at = now();
            $user->save();

            // send mail
            UserJob::dispatch(['action' => UserJob::ACTION_ACTIVE_MAIL, 'id' => $user->id]);

            // set permission
            $user->assignRole([Role::ROLE_KEY[$user->role_id]]);

            // redirect message
            $request->session()->flash('success', trans('user.active.success'));

            return redirect(admin_url('users'), 302);
        } else {
            $request->session()->flash('error', trans('user.active.error'));
        }

        return redirect(base_url());
    }
}
