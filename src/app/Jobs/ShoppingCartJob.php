<?php

namespace App\Jobs;

use App\Mail\ShoppingCart;
use App\Models\Config;
use App\Models\SaleOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ShoppingCartJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    const ACTION_SEND_MAIL_CUSTOMER = 'send_mail_customer';
    const ACTION_RESEND_EMAIL_ORDER = 'resend_mail_order';

    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function handle()
    {
        $action = $this->data['action'] ?? '';
        switch ($action) {
            case self::ACTION_SEND_MAIL_CUSTOMER:
                $this->sendMailCustomer($this->data['id']);
                break;
            case self::ACTION_RESEND_EMAIL_ORDER:
                $this->resendMailOrder($this->data['id']);
                break;
        }
    }

    private function sendMailCustomer($saleOrderId)
    {
        $mySaleOrder = SaleOrder::query()->find($saleOrderId);
        if (empty($mySaleOrder->id) || empty($mySaleOrder->billing_email)) {
            return null;
        }

        $config = Config::query()->where('name', 'company_name')->first();
        $configEmail = Config::query()->where('name', 'company_email')->first();

        Mail::send(
            new ShoppingCart(
                [
                    'action' => ShoppingCart::ACTION_SEND_MAIL_CUSTOMER,
                    'email' => $configEmail->value,
                    'email_cc' => $mySaleOrder->billing_email,
                    'sale_order_line' => $mySaleOrder->sale_order_lines->toArray(),
                    'sale_order' => $mySaleOrder->toArray(),
                    'company_name' => $config->value ?? '',
                ]
            )
        );
    }

    private function resendMailOrder($saleOrderId)
    {
        $mySaleOrder = SaleOrder::query()->find($saleOrderId);
        if (empty($mySaleOrder->id) || empty($mySaleOrder->billing_email)) {
            return null;
        }

        $config = Config::query()->where('name', 'company_name')->first();
        $configEmail = Config::query()->where('name', 'company_email')->first();

        Mail::send(
            new ShoppingCart(
                [
                    'action' => ShoppingCart::ACTION_RESEND_MAIL_ORDER,
                    'email' => $configEmail->value,
                    'email_cc' => $mySaleOrder->billing_email,
                    'sale_order_line' => $mySaleOrder->sale_order_lines->toArray(),
                    'sale_order' => $mySaleOrder->toArray(),
                    'company_name' => $config->value ?? '',
                ]
            )
        );
    }
}
