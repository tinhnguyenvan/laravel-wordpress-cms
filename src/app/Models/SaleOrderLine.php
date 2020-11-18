<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleOrderLine extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sale_order_line';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_id',
        'customer_id',
        'order_id',
        'sale_store_id',
        'order_code',
        'product_id',
        'product_sku',
        'product_name',
        'product_group_id',
        'product_category_id',
        'product_unit_id',
        'product_type_id',
        'product_division_id',
        'quantity',
        'item_price_cost',
        'item_price_sell',
        'cost_total',
        'sub_total',
        'status',
        'report_year',
        'report_month',
        'report_date',
        'creator_id',
        'editor_id',
        'completed_at',
        'cancelled_at',
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
    protected $dates = ['completed_at', 'cancelled_at', 'deleted_at', 'created_at', 'updated_at'];
}
