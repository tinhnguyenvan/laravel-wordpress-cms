<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    const GUARD_NAME_WEB = 'web';
    const GUARD_NAME_ADMIN = 'admin';

    const ACTION_SHOW = 'show';
    const ACTION_ADD = 'add';
    const ACTION_EDIT = 'edit';
    const ACTION_DELETE = 'delete';
    const ACTION_ACTIVE = 'active';
    const ACTION_SEND_REQUEST = 'send_request';
    const ACTION_CONFIG = 'config';

    // dashboard
    const DASHBOARD_SHOW = 'dashboard.' . self::ACTION_SHOW;
    const LIST_PERMISSION_DASHBOARD = [
        '1' => self::DASHBOARD_SHOW,
    ];

    // post
    const POST_SHOW = 'post.' . self::ACTION_SHOW;
    const LIST_PERMISSION_POST = [
        '10' => self::POST_SHOW,
    ];

    // product
    const PRODUCT_SHOW = 'product.' . self::ACTION_SHOW;
    const LIST_PERMISSION_PRODUCT = [
        '20' => self::PRODUCT_SHOW,
    ];

    // page
    const PAGE_SHOW = 'page.' . self::ACTION_SHOW;
    const LIST_PERMISSION_PAGE = [
        '30' => self::PAGE_SHOW,
    ];

    // comment
    const COMMENT_SHOW = 'comment.' . self::ACTION_SHOW;
    const LIST_PERMISSION_COMMENT = [
        '40' => self::COMMENT_SHOW,
    ];

    // media
    const MEDIA_SHOW = 'media.' . self::ACTION_SHOW;
    const LIST_PERMISSION_MEDIA = [
        '50' => self::MEDIA_SHOW,
    ];

    // setting
    const SETTING_SHOW = 'setting.' . self::ACTION_SHOW;
    const LIST_PERMISSION_SETTING = [
        '60' => self::SETTING_SHOW,
    ];

    // user
    const USER_SHOW = 'user.' . self::ACTION_SHOW;
    const LIST_PERMISSION_USER = [
        '70' => self::USER_SHOW,
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_permissions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'guard_name',
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
    protected $dates = ['created_at', 'updated_at'];

    const PERMISSION_ALLOW_MANAGER = [
        // Tổng quan
        self::DASHBOARD_SHOW,

        // product
        self::PRODUCT_SHOW,

        // post
        self::POST_SHOW,

        // page
        self::PAGE_SHOW,

        // comment
        self::COMMENT_SHOW,

        // media
        self::MEDIA_SHOW,

        // setting
        self::SETTING_SHOW,
    ];

    const PERMISSION_ALLOW_EDITOR = [
        // Tổng quan
        self::DASHBOARD_SHOW,

        // product
        self::PRODUCT_SHOW,

        // post
        self::POST_SHOW,

        // page
        self::PAGE_SHOW,

        // comment
        self::COMMENT_SHOW,

        // media
        self::MEDIA_SHOW,
    ];
}
