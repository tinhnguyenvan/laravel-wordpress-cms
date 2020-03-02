<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrder extends Model
{
    use SoftDeletes;

    const STATUS_NEW = 1; // Trạng thái mới
    const STATUS_VERIFIED = 3; // Xác nhận
    const STATUS_PROCESSING = 5; // Đang xử lý
    const STATUS_DELIVERING = 7; // Đang giao hàng
    const STATUS_DELIVERED = 9; // Đã giao hàng
    const STATUS_COMPLETED = 11; // Hoàn thành
    const STATUS_CANCELLED = 13; // Huỷ"

    const PAYMENT_METHOD_CASH = 1; // Tiền mặt
    const PAYMENT_METHOD_BANK = 3; // Chuyển khoản ngân hàng
    const PAYMENT_METHOD_DEBIT_CREDIT = 5; // Debit / Credit Card
    const PAYMENT_METHOD_COD = 7; // Trả tiền khi nhận hàng"

    const IS_GENERATE_INVOICE = 1;

    const STATUS_LIST = [
        self::STATUS_NEW,
        self::STATUS_VERIFIED,
        self::STATUS_PROCESSING,
        self::STATUS_DELIVERING,
        self::STATUS_DELIVERED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sale_order';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_id',
        'code',
        'customer_id',
        'sale_store_id',
        'inventory_warehouse_id',
        'payment_method',
        'billing_fullname',
        'billing_email',
        'billing_gender',
        'billing_phone',
        'billing_address',
        'billing_city_id',
        'billing_district_id',
        'billing_ward_id',
        'shipping_fullname',
        'shipping_phone',
        'shipping_address',
        'shipping_city_id',
        'shipping_district_id',
        'shipping_ward_id',
        'tags',
        'note',
        'cancel_reason',
        'price_cost',
        'price_sell',
        'price_tax',
        'price_discount',
        'price_final',
        'sell_type',
        'is_generate_invoice',
        'invoice_code',
        'invoice_id',
        'status',
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
    protected $casts = ['is_generate_invoice' => 'boolean'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['completed_at', 'cancelled_at', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function sale_order_lines()
    {
        return $this->hasMany(SaleOrderLine::class, 'order_id', 'id');
    }

    public static function generateCode()
    {
        $code = IdGenerator::generate(['table' => (new self())->table, 'field' => 'code', 'length' => 10, 'prefix' => 'SO']);

        return $code;
    }

    public static function dropDownStatus()
    {
        $data = self::STATUS_LIST;

        $html = [];
        foreach ($data as $value) {
            $html[$value] = trans('sale_order.status.'.$value);
        }

        return $html;
    }

    /**
     * text status.
     *
     * @return string
     */
    public function getStatusTextAttribute()
    {
        if ($this->status > 0) {
            $text = trans('sale_order.status.'.$this->status);
        } else {
            $text = '--';
        }

        return $text;
    }

    /**
     * color status.
     *
     * @return string
     */
    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                $text = 'primary';
                break;
            case self::STATUS_VERIFIED:
                $text = 'info';
                break;
            case self::STATUS_PROCESSING:
                $text = 'info';
                break;
            case self::STATUS_DELIVERING:
                $text = 'info';
                break;
            case self::STATUS_DELIVERED:
                $text = 'success';
                break;
            case self::STATUS_COMPLETED:
                $text = 'success';
                break;
            case self::STATUS_CANCELLED:
                $text = 'warning';
                break;
            default:
                $text = 'default';
                break;
        }

        return $text;
    }
}
