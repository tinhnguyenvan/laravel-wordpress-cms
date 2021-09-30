<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use willvincent\Rateable\Rateable;
use Astrotomic\Translatable\Translatable;

/**
 * @package App\Models
 *
 * @method static active()
 * @method static filter()
 */
class Post extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Rateable;
    use StatusTrait;
    use Translatable;

    public $translatedAttributes = [
        'title',
        'summary',
        'detail',
        'slug',
        'seo_title',
        'seo_description'
    ];

    public const STATUS_ACTIVE = 1;
    public const STATUS_DISABLE = 2;
    public const STATUS_LIST = [
        self::STATUS_ACTIVE,
        self::STATUS_DISABLE,
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'web_posts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'image_id',
        'image_url',
        'status',
        'views',
        'tags',
        'is_hot',
        'deleted_at',
        'created_at',
        'updated_at',
        'creator_id',
        'editor_id',
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

    protected $with = ['translations', 'category'];

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Docs: https://laracasts.com/series/laravel-8-from-scratch/episodes/38
     *
     * @param $query
     * @param  array  $filters
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->whereTranslationLike('title', '%'.$search.'%');
        });

        $query->when($filters['status'] ?? false, function ($query, $status) {
            $query->where('status', $status);
        });

        $query->when($filters['category_id'] ?? false, function ($query, $categoryId) {
            $query->where('category_id', $categoryId);
        });

        // filter slug category
        $query->when($filters['slug_category'] ?? false, function ($query, $slugCategory) {
            $query->whereHas('category', function ($query) use ($slugCategory) {
                $query->where('slug', $slugCategory);
            });
        });
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public static function dropDownStatus(): array
    {
        $data = self::STATUS_LIST;

        $html = [];
        foreach ($data as $value) {
            $html[$value] = trans('post.status.'.$value);
        }

        return $html;
    }

    public function getLinkAttribute(): string
    {
        $prefix = $this->category->slug ?? 'no-category';

        if (empty($this->slug)) {
            $this->slug = '1';
        }

        return base_url($prefix.'/'.$this->slug.'.html');
    }

    public static function image($item)
    {
        return null;
    }

    /**
     * text status.
     *
     * @return string
     */
    public function getStatusTextAttribute(): string
    {
        switch ($this->status) {
            case self::STATUS_DISABLE:
                $text = trans('post.status.disable');
                break;
            case self::STATUS_ACTIVE:
                $text = trans('post.status.active');
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
            case self::STATUS_ACTIVE:
                $text = 'success';
                break;
            default:
                $text = 'default';
                break;
        }

        return $text;
    }

    public function getFullImageUrlAttribute(): string
    {
        if ($this->image_id > 0) {
            return asset('storage'.$this->image_url);
        } else {
            if (!empty($this->image_url)) {
                return $this->image_url;
            }
        }

        return asset('site/img/empty.svg');
    }
}
