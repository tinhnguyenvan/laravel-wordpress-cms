<?php

namespace App\Jobs;

use App\Mail\UserActiveSuccess;
use App\Models\Config;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    const ACTION_ACTIVE_MAIL = 'active_success';

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
                $this->activeSuccess($this->data['id'] ?? 0);
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
    public function activeSuccess($id)
    {
        $user = User::query()->find($id);
        if (empty($user->id) || !empty($user->email_verified_at)) {
            return null;
        }

        $config = Config::query()->where('name', 'company_name')->first();

        Mail::send(new UserActiveSuccess([
            'name' => $user->name,
            'email' => $user->email,
            'company_name' => $config->value ?? '',
        ]));

        $user->email_verified_at = now();
        $user->save();
    }
}
