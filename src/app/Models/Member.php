<?php

namespace App\Models;

use App\Traits\BookmarkTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static find(int|string|null $memberId)
 * @method static active()
 * @method static type($type)
 */
class Member extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use BookmarkTrait;

    public const MEMBER_TYPE_NORMAL = 0;

    public const GENDER_FEMALE = 0; // nu
    public const GENDER_MALE = 1; // nam
    public const GENDER_OTHER = 2; // khong xac dinh

    public const STATUS_ACTIVE = 1;
    public const STATUS_WAITING_ACTIVE = 3;
    public const STATUS_BLOCK = 5;
    public const STATUS_LIST = [
        self::STATUS_ACTIVE,
        self::STATUS_WAITING_ACTIVE,
        self::STATUS_BLOCK,
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_members';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_type',
        'username',
        'password',
        'fullname',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'status',
        'country_id',
        'city_id',
        'district_id',
        'ward_id',
        'birth_day',
        'birth_month',
        'birth_year',
        'birthday',
        'image_id',
        'image_url',
        'gender',
        'tags',
        'bio',
        'id_hash',
        'deleted_at',
        'created_at',
        'updated_at'
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
    protected $dates = ['birthday', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeType($query, $type)
    {
        return $query->where('member_type', $type);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }


    public static function dropDownStatus()
    {
        $data = self::STATUS_LIST;

        $html = [];
        foreach ($data as $value) {
            $html[$value] = trans('member.status.' . $value);
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
        return trans('member.status.' . $this->status);
    }

    /**
     * color status.
     *
     * @return string
     */
    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case self::STATUS_BLOCK:
                $text = 'danger';
                break;
            case self::STATUS_WAITING_ACTIVE:
                $text = 'warning';
                break;
            case self::STATUS_ACTIVE:
                $text = 'success';
                break;
            default:
                $text = 'default';
                break;
        }

        return $text;
    }

    public function socials()
    {
        return $this->hasMany(MemberSocialAccount::class);
    }

    /** notification
     *
     * @param $notification
     * @return array|mixed
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }


    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
