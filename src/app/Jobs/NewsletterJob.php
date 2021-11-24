<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use MailchimpMarketing\ApiClient;

class NewsletterJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $data;

    /**
     * @param array $data
     *  - email
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function handle(): bool
    {
        if ('' == $this->data['email'] || !filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $mailchimp = new ApiClient();

        $mailchimp->setConfig(
            [
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us5'
            ]
        );

        try {
            $mailchimp->lists->addListMember(
                config('services.mailchimp.lists.subscribers'),
                [
                    "email_address" => $this->data['email'],
                    "status" => "subscribed"
                ]
            );

            return true;
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return false;
        }
    }
}
