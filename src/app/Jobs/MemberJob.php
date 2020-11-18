<?php

namespace App\Jobs;

use App\Mail\MemberMail;
use App\Models\Config;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MemberJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    const ACTION_ACTIVE_MAIL = 'active_email';
    const ACTION_ACTIVE_SUCCESS = 'active_success';
    const ACTION_FORGOT_PASSWORD = 'forgot_password';

    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $action = $this->data['action'] ?? '';
        switch ($action) {
            case self::ACTION_ACTIVE_MAIL:
                $this->activeMail($this->data['id'] ?? 0);
                break;
            case self::ACTION_ACTIVE_SUCCESS:
                $this->activeSuccess($this->data['id'] ?? 0);
                break;
            case self::ACTION_FORGOT_PASSWORD:
                $this->forgotPassword($this->data);
                break;
        }
    }

    /**
     * send mail kich hoat thanh cong.
     *
     * @param $id
     *
     * @return null
     */
    public function activeMail($id)
    {
        $member = Member::query()->find($id);
        if (empty($member->id)) {
            return null;
        }

        $config = Config::query()->where('name', 'company_name')->first();

        Mail::send(new MemberMail([
            'action' => MemberMail::ACTION_ACTIVE_MEMBER,
            'name' => $member->email,
            'email' => $member->email,
            'company_name' => $config->value ?? '',
        ]));

        $member->updated_at = now();
        $member->save();

        return true;
    }

    public function activeSuccess($id)
    {
        $member = Member::query()->find($id);
        if (empty($member->id)) {
            return null;
        }

        $config = Config::query()->where('name', 'company_name')->first();

        Mail::send(new MemberMail([
            'action' => MemberMail::ACTION_ACTIVE_MEMBER_SUCCESS,
            'name' => $member->email,
            'email' => $member->email,
            'company_name' => $config->value ?? '',
        ]));

        $member->updated_at = now();
        $member->save();
    }

    public function forgotPassword($params)
    {
        $member = Member::query()->find($params['id']);
        if (empty($member->id)) {
            return null;
        }

        $config = Config::query()->where('name', 'company_name')->first();

        Mail::send(new MemberMail([
            'action' => MemberMail::ACTION_FORGOT_PASSWORD,
            'password' => $params['password'],
            'name' => $member->email,
            'email' => $member->email,
            'company_name' => $config->value ?? '',
        ]));

        $member->updated_at = now();
        $member->save();
    }
}
