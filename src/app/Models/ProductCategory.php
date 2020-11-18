<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ProductCategory extends Model
{
    use SoftDeletes;
    // use HasTranslations;

    public $translatable = ['title', 'summary', 'detail'];


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
    protected $table = 'product_categories';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id',
        'title',
        'slug',
        'level',
        'description',
        'image_id',
        'image_url',
        'total_usage',
        'seo_title',
        'seo_description',
        'creator_id',
        'editor_id',
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

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'id', 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function dropDownStatus()
    {
        $data = self::STATUS_LIST;

        $html = [];
        foreach ($data as $value) {
            $html[$value] = trans('product.status.' . $value);
        }

        return $html;
    }

    public static function link($data)
    {
        $prefix = config('constant.URL_PREFIX_PRODUCT');

        return base_url($prefix . '/' . $data['slug']);
    }
}
