<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
    protected $table = 'regions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'address',
        'level',
        'source_id',
        'source_parent_id',
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

    public function cities()
    {
        return $this->hasMany(Region::class, 'source_parent_id', 'source_id')->where('level', '=', 2);
    }

    public function districts()
    {
        return $this->hasMany(Region::class, 'source_parent_id', 'source_id')->where('level', '=', 3);
    }
}
