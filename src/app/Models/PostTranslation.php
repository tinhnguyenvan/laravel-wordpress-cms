<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'summary',
        'detail',
        'slug',
        'seo_title',
        'seo_description',
    ];
}
