<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostTag extends Model
{
    use SoftDeletes;

    const SOURCE_POST = 1;
    const SOURCE_PRODUCT = 2;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_tags';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'source_id',
        'source',
        'description',
        'total_usage',
        'creator_id',
        'editor_id',
        'deleted_at',
        'created_at',
        'updated_at',
        'seo_title',
        'seo_description',
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

    public static function link($object)
    {
        $prefix = config('constant.URL_PREFIX_TAG');

        return base_url($prefix . '/' . $object->slug);
    }

    /**
     * @param $tags
     * @param $source
     * @param $sourceId
     *
     * @return null
     */
    public static function insertOrUpdateTags($tags, $source, $sourceId)
    {
        if (empty($tags)) {
            return null;
        }

        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            $formData = [
                'slug' => Str::slug($tag),
            ];

            $myTag = self::query()->where($formData)->first();
            if (!empty($myTag)) {
                $myTag->increment('total_usage');
                continue;
            }

            $formData['title'] = $tag;
            $formData['creator_id'] = Auth::id();
            $formData['source'] = $source;
            $formData['source_id'] = $sourceId;
            $myObject = new self($formData);
            $myObject->save($formData);
        }
    }

    /**
     * text status.
     *
     * @return string
     */
    public function getSourceTextAttribute()
    {
        switch ($this->source) {
            case self::SOURCE_PRODUCT:
                $text = trans('post.source_product');
                break;
            case self::SOURCE_POST:
                $text = trans('post.source_post');
                break;
            default:
                $text = '--';
                break;
        }

        return $text;
    }
}
