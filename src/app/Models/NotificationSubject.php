<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;

/**
 * @method static find($id)
 */
class NotificationSubject extends DatabaseNotification
{
    use SoftDeletes;

    public const STATUS_DISABLE = 0;
    public const STATUS_NEW = 1;
    public const STATUS_PROCESSING = 2;
    public const STATUS_SUCCESS = 3;
    public const STATUS_LIST = [
        self::STATUS_DISABLE,
        self::STATUS_NEW,
        self::STATUS_PROCESSING,
        self::STATUS_SUCCESS,
    ];

    protected $table = 'web_notification_subjects';

    protected $fillable = [
        'type',
        'title',
        'content',
        'status',
        'total',
        'total_success',
        'total_fail',
        'total_processing',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * text status.
     *
     * @return string
     */
    public function getStatusTextAttribute(): string
    {
        switch ($this->status) {
            case self::STATUS_DISABLE:
                $text = trans('common.status.disable');
                break;
            case self::STATUS_NEW:
                $text = trans('common.status.new');
                break;
            case self::STATUS_PROCESSING:
                $text = trans('common.status.processing');
                break;
            case self::STATUS_SUCCESS:
                $text = trans('common.status.success');
                break;
            default:
                $text = '--';
                break;
        }

        return $text;
    }

    /**
     * color status.
     *
     * @return string
     */
    public function getStatusColorAttribute(): string
    {
        switch ($this->status) {
            case self::STATUS_DISABLE:
                $text = 'danger';
                break;
            case self::STATUS_NEW:
                $text = 'warning';
                break;
            case self::STATUS_PROCESSING:
                $text = 'primary';
                break;
            case self::STATUS_SUCCESS:
                $text = 'success';
                break;
            default:
                $text = 'default';
                break;
        }

        return $text;
    }
}
