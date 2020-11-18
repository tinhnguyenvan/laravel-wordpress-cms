<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    const ACTION_ACTIVE_MEMBER = 'active_member';
    const ACTION_ACTIVE_MEMBER_SUCCESS = 'active_member_success';
    const ACTION_FORGOT_PASSWORD = 'forgot_password';

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $action = $this->data['action'] ?? '';
        $params = $this->data;
        switch ($action) {
            case self::ACTION_ACTIVE_MEMBER:
                $this->sendMailActive($params);
                break;
            case self::ACTION_ACTIVE_MEMBER_SUCCESS:
                $this->sendMailActiveSuccess($params);
                break;
            case self::ACTION_FORGOT_PASSWORD:
                $this->sendMailForgotPassword($params);
                break;
        }
    }

    private function sendMailActive($params)
    {
        return $this->to($this->data['email'])
            ->subject(trans('member.subject.send_mail_active'))
            ->view('site.email.member.send_mail_active', compact('params'));
    }

    private function sendMailActiveSuccess($params)
    {
        return $this->to($this->data['email'])
            ->subject(trans('user.subject.active_user_success'))
            ->view('site.email.member.active_success', compact('params'));
    }

    private function sendMailForgotPassword($params)
    {
        return $this->to($this->data['email'])
            ->subject(trans('user.subject.forgot_password'))
            ->view('site.email.member.forgot_password', compact('params'));
    }
}
