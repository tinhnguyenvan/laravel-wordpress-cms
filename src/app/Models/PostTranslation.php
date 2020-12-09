<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    protected $table = 'web_post_translations';

    protected $fillable = [
        'title',
        'summary',
        'detail',
        'slug',
        'seo_title',
        'seo_description',
    ];
}
