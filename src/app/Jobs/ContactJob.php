<?php

namespace App\Jobs;

use App\Mail\ContactMail;
use App\Models\Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ContactJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    const ACTION_REGISTER = 'register';
    const ACTION_FORM = 'form';

    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function handle()
    {
        $action = $this->data['action'] ?? '';
        switch ($action) {
            case self::ACTION_REGISTER:
                $this->sendMailRegister($this->data['email']);
                break;
            case self::ACTION_FORM:
                $this->sendMailForm($this->data['params']);
                break;
        }
    }

    private function sendMailRegister($email)
    {
        $config = Config::query()->where('name', 'company_name')->first();
        $configEmail = Config::query()->where('name', 'company_email')->first();

        Mail::send(new ContactMail([
            'action' => ContactMail::ACTION_REGISTER,
            'email' => $email,
            'email_cc' => $configEmail->value,
            'company_name' => $config->value ?? '',
        ]));
    }

    private function sendMailForm($params)
    {
        $config = Config::query()->where('name', 'company_name')->first();
        $configEmail = Config::query()->where('name', 'company_email')->first();

        Mail::send(new ContactMail([
            'action' => ContactMail::ACTION_FORM,
            'email' => $params['email'],
            'email_cc' => $configEmail->value,
            'params' => $params,
            'company_name' => $config->value ?? '',
        ]));
    }
}
