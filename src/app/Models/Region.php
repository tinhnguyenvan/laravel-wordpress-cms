<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;

    public const SOURCE_PARENT_ID_VN = 241;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_regions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'parent_id',
        'is_primary_location',
        'order_by',
        'created_at',
        'updated_at',
        'deleted_at'
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
    protected $casts = ['is_primary_location' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function subItem(): HasMany
    {
        return $this->hasMany('App\Models\Region', 'parent_id');
    }

    public static function getRegion($parentId = 0, $limit = 10)
    {
        return Region::query()->where('parent_id', $parentId)->limit($limit)->get(['id', 'code', 'name']);
    }
}
