<?php

namespace App\Jobs;

use App\Mail\CommentMail;
use App\Models\Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CommentJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $data;

    /**
     * @param array $data
     *  - comment_id
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function handle()
    {
        $config = Config::query()->where('name', 'company_name')->first();
        $configEmail = Config::query()->where('name', 'company_email')->first();

        $params = [
            'email' => $configEmail->value,
            'comment_id' => $this->data['comment_id'],
            'company_name' => $config->value ?? '',
        ];

        Mail::send(new CommentMail($params));
    }
}
