<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;

/**
 * @method static find($id)
 */
class Notification extends DatabaseNotification
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'web_notifications';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'notifiable_type', 'notifiable_id', 'data', 'read_at', 'created_at', 'updated_at'];

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
    protected $dates = ['read_at', 'created_at', 'updated_at'];

    /**
     * @return string
     */
    public function getTitleAttribute() : string
    {
        $title = '';
        if (!empty($this->data)) {
            $data = json_decode($this->data, true);
            $title = $data['title'] ?? '';
        }

        return $title;
    }

    /**
     * @return string
     */
    public function getStatusTextAttribute() : string
    {
        $title = 'Read';
        if (empty($this->read_at)) {
            $title = 'Unread';
        }

        return $title;
    }

    /**
     * @return string
     */
    public function getStatusColorAttribute() : string
    {
        $title = 'warning';
        if (empty($this->read_at)) {
            $title = 'primary';
        }

        return $title;
    }
}
