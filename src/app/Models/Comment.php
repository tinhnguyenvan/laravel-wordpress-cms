<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed status
 */
class Comment extends Model
{
    use SoftDeletes;

    public const TYPE_POST = 1;

    public const STATUS_NEW = 1; // Trạng thái mới
    public const STATUS_APPROVED = 3; // Xác nhận
    public const STATUS_REJECT = 5; // hủy

    public const STATUS_LIST = [
        self::STATUS_NEW,
        self::STATUS_APPROVED,
        self::STATUS_REJECT,
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'web_comments';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'rating_id',
        'author',
        'author_email',
        'author_url',
        'author_ip',
        'date',
        'content',
        'status',
        'agent',
        'type',
        'parent',
        'user_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date', 'deleted_at', 'created_at', 'updated_at'];

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public static function dropDownStatus(): array
    {
        $data = self::STATUS_LIST;

        $html = [];
        foreach ($data as $value) {
            $html[$value] = trans('comment.status.' . $value);
        }

        return $html;
    }

    /**
     * text status.
     *
     * @return string
     */
    public function getStatusTextAttribute(): string
    {
        switch ($this->status) {
            case self::STATUS_REJECT:
                $text = trans('comment.status.reject');
                break;
            case self::STATUS_APPROVED:
                $text = trans('comment.status.approved');
                break;
            default:
                $text = trans('comment.status.news');
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
            case self::STATUS_REJECT:
                $text = 'danger';
                break;
            case self::STATUS_APPROVED:
                $text = 'success';
                break;
            default:
                $text = 'info';
                break;
        }

        return $text;
    }
}
