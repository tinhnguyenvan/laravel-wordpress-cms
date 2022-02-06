<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    public const STATUS_NEW = 1;
    public const STATUS_COMPLETED = 2;
    public const STATUS_LIST = [
        self::STATUS_NEW,
        self::STATUS_COMPLETED,
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'web_contact';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'phone',
        'email',
        'contact_form_id',
        'request_title',
        'request_content_form',
        'status',
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
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];


    /**
     * text status.
     *
     * @return string
     */
    public function getStatusTextAttribute(): string
    {
        switch ($this->status) {
            case self::STATUS_COMPLETED:
                $text = trans('contact.status.completed');
                break;
            case self::STATUS_NEW:
                $text = trans('contact.status.new');
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
            case self::STATUS_COMPLETED:
                $text = 'success';
                break;
            case self::STATUS_NEW:
                $text = 'warning';
                break;
            default:
                $text = 'default';
                break;
        }

        return $text;
    }

}
