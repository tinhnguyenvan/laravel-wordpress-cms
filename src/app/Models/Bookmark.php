<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'web_bookmarks';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['model_type', 'model_id', 'user_id', 'created_at', 'updated_at'];

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

    public function model()
    {
        return $this->belongsTo($this->model_type, 'model_id', 'id');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public function getTitleAttribute()
    {
        switch ($this->model_type) {
            case Post::class:
                $title = $this->model->title;
                break;
            default:
                $title = '--';
                break;
        }

        return $title;
    }

    public function getLinkAttribute()
    {
        switch ($this->model_type) {
            case Post::class:
                $link = $this->model->link;
                break;
            default:
                $link = '--';
                break;
        }

        return $link;
    }
}
