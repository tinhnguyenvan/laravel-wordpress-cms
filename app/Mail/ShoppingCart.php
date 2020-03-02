<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShoppingCart extends Mailable
{
    use Queueable;
    use SerializesModels;

    const ACTION_SEND_MAIL_CUSTOMER = 'send_mail_customer';

    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function build()
    {
        $action = $this->data['action'] ?? '';
        $params = $this->data;
        switch ($action) {
            case self::ACTION_SEND_MAIL_CUSTOMER:
                $this->sendMailCustomer($params);
                break;
        }
    }

    private function sendMailCustomer($params)
    {
        return $this->to($this->data['email'])
            ->cc($this->data['email_cc'])
            ->subject(trans('sale_order.subject.send_mail_customer'))
            ->view('site.email.sale_order.send_mail_customer', $params);
    }
}
