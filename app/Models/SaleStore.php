<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleStore extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sale_store';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_id',
        'code',
        'name',
        'phone',
        'address',
        'country_code',
        'city_id',
        'city_name',
        'district_id',
        'district_name',
        'ward_id',
        'ward_name',
        'inventory_warehouse_id',
        'supervisor_id',
        'status',
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
}
