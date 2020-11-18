<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMIN = 1; // Quản trị viên
    const ROLE_MANAGER_MANAGER = 2; // Quản lý cửa hàng
    const ROLE_EDITOR = 3; // Biên tập viên
    const ROLE_MEMBER = 4; // Thàng viên

    const ROLE_CODE_ADMIN = 'admin';
    const ROLE_CODE_MANAGER_MANAGER = 'manager';
    const ROLE_CODE_EDITOR = 'editor';
    const ROLE_CODE_MEMBER = 'member';

    const ROLE_KEY = [
        self::ROLE_ADMIN => self::ROLE_CODE_ADMIN,
        self::ROLE_MANAGER_MANAGER => self::ROLE_CODE_MANAGER_MANAGER,
        self::ROLE_EDITOR => self::ROLE_CODE_EDITOR,
        self::ROLE_MEMBER => self::ROLE_CODE_MEMBER,
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'guard_name', 'created_at', 'updated_at'];

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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function role_permissions()
    {
        return $this->hasMany(RoleHasPermission::class);
    }
}
