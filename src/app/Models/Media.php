<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public const OBJECT_TYPE_GENERAL = 0;
    public const OBJECT_TYPE_POST = 1;
    public const OBJECT_TYPE_POST_CATEGORY = 2;
    public const OBJECT_TYPE_PRODUCT = 3;
    public const OBJECT_TYPE_PRODUCT_CATEGORY = 4;
    public const OBJECT_TYPE_ADS = 5;
    public const OBJECT_TYPE_CLASSIFIED = 6;
    public const OBJECT_TYPE_CLASSIFIED_CATEGORY = 7;
    public const OBJECT_TYPE_QR_CODE = 8;
    public const OBJECT_TYPE_MEMBER = 9;
    public const OBJECT_TYPE_SCHOOL = 10;
    public const OBJECT_TYPE_COLLEGE_DEPARTMENT = 11;
    public const OBJECT_TYPE_SCHOOL_COLLEGE = 12;
    public const OBJECT_TYPE_SCHOOL_NEWS_FEED = 13;

    public const OBJECT_TYPE_NAME = [
        0 => 'General',
        1 => 'Post',
        2 => 'Post Category',
        3 => 'Product',
        4 => 'Product Category',
        5 => 'Ads',
        6 => 'Classified',
        7 => 'Classified Category',
        8 => 'Qr Code',
        9 => 'Member',
        10 => 'School',
        11 => 'School department',
        12 => 'School college',
        13 => 'School news feed',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_medias';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'collection_name',
        'name',
        'file_name',
        'mime_type',
        'disk',
        'size',
        'manipulations',
        'custom_properties',
        'responsive_images',
        'order_column',
        'object_type',
        'object_id',
        'status',
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
    protected $dates = ['created_at', 'updated_at'];

    public function getObjectTypeNameAttribute()
    {
        return self::OBJECT_TYPE_NAME[$this->object_type] ?? '-';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
