<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfigMail extends Mailable
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

        return $this->to($this->data['config_email_test_to'])
            ->subject($this->data['config_email_test_subject'])
            ->view('site.email.config.test', $data);
    }
}
