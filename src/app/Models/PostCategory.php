<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'web_post_categories';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'level',
        'description',
        'image_id',
        'image_url',
        'views',
        'seo_title',
        'seo_description',
        'creator_id',
        'editor_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function parent()
    {
        return $this->belongsTo(PostCategory::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(PostCategory::class, 'id', 'parent_id');
    }

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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getLinkAttribute()
    {
        return base_url($this->slug);
    }
}
