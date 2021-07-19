<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    protected $table = 'web_bookmarks';

    protected $fillable = [
        'model_type',
        'model_id',
        'sub_model_type',
        'sub_model_id',
        'user_id',
        'member_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];

    protected $casts = [];

    public function model(): BelongsTo
    {
        return $this->belongsTo($this->model_type, 'model_id', 'id');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

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
