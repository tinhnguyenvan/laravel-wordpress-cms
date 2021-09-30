<?php

namespace App\Console\Commands;

use App\Models\Member;
use App\Models\Notification;
use App\Models\NotificationSubject;
use Illuminate\Console\Command;

class NotificationCreateCommand extends Command
{
    protected $signature = 'notification:create';

    protected $description = 'Push notification every 1 hours';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sinceMemberId = 0;
        $this->alert($this->description);
        $notificationSubjects = NotificationSubject::query()
            ->where('status', NotificationSubject::STATUS_NEW)
            ->orderBy('id')
            ->limit(10)
            ->get();

        $total = 0;
        foreach ($notificationSubjects as $notificationSubject) {
            $this->info(' - create notification object: ' . $notificationSubject->title);
            $notificationSubject->status = NotificationSubject::STATUS_PROCESSING;
            $notificationSubject->save();


            do {
                $members = Member::query()
                    ->where('status', Member::STATUS_ACTIVE)
                    ->where('id', '>', $sinceMemberId)
                    ->orderBy('id')
                    ->limit(100)
                    ->get();

                foreach ($members as $member) {
                    $total++;

                    $sinceMemberId = $member->id;
                    $dataCondition = [
                        'notification_subject_id' => $notificationSubject->id,
                        'notifiable_id' => $member->id,
                        'notifiable_type' => Member::class,
                    ];
                    $dataValue = [
                        'type' => 0,
                        'id' => 'm_' . $notificationSubject->id . '_' . $member->id,
                        'data' => [
                            'content' => $notificationSubject->content
                        ]
                    ];
                    Notification::query()->updateOrCreate($dataCondition, $dataValue);

                    $this->alert(' - member ID: ' . $member->id);
                }
            } while ($members->count() > 0);

            $notificationSubject->total = $total;
            $notificationSubject->status = NotificationSubject::STATUS_SUCCESS;
            $notificationSubject->save();
        }
    }
}
