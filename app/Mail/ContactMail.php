<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    const ACTION_REGISTER = 'register';
    const ACTION_FORM = 'form';

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
            case self::ACTION_REGISTER:
                $this->sendMailRegister($params);
                break;
            case self::ACTION_FORM:
                $this->sendMailContactForm($params);
                break;
        }
    }

    private function sendMailRegister($params)
    {
        return $this->to($this->data['email'])
            ->cc($this->data['email_cc'])
            ->subject(trans('contact.subject.send_mail_register'))
            ->view('site.email.contact.send_mail_register', compact('params'));
    }

    private function sendMailContactForm($params)
    {
        return $this->to($this->data['email'])
            ->cc($this->data['email_cc'])
            ->subject(trans('contact.subject.send_mail_form_contact'))
            ->view('site.email.contact.send_mail_form', compact('params'));
    }
}
