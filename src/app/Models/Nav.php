<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Nav extends Model
{
    public const TYPE_LINK = 0;
    public const TYPE_PAGE = 1;
    public const TYPE_CATEGORY_POST = 2;
    public const TYPE_CATEGORY_PRODUCT = 3;

    use SoftDeletes;
    // use HasTranslations;

    public $translatable = ['title'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'navs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'title',
        'value',
        'level',
        'type',
        'position',
        'order_by',
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

    public static function dropDownType()
    {
        return [
            self::TYPE_LINK => trans('nav.type.link'),
            self::TYPE_PAGE => trans('nav.type.page'),
            self::TYPE_CATEGORY_POST => trans('nav.type.category_post'),
        ];
    }

    public static function menu($position, $parentId = 0)
    {
        return Nav::query()->where(['position' => $position, 'parent_id' => $parentId])->orderBy('order_by', 'ASC')->get();
    }

    public static function menuTree($position)
    {
        return Nav::query()->where(['position' => $position])
            ->orderByRaw('CASE WHEN parent_id = 0 THEN id ELSE parent_id END, parent_id,id')
            ->get();
    }
}
