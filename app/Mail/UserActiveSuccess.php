<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserActiveSuccess extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = ['params' => $this->data];

        return $this->to($this->data['email'])
            ->subject(trans('user.subject.active_user_success'))
            ->view('site.email.user.active_success', $data);
    }
}
