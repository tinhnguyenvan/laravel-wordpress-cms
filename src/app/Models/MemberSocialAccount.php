<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberSocialAccount extends Model
{
    public const PROVIDER_EMAIL = 'email';
    public const PROVIDER_FACEBOOK = 'facebook';
    public const PROVIDER_GOOGLE = 'google';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_member_social_accounts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'provider_id', 'provider', 'created_at', 'updated_at'];

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

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * color status.
     *
     * @return string
     */
    public function getProviderColorAttribute()
    {
        switch ($this->provider) {
            case self::PROVIDER_FACEBOOK:
                $text = 'primary';
                break;
            case self::PROVIDER_GOOGLE:
                $text = 'danger';
                break;
            default:
                $text = 'default';
                break;
        }

        return $text;
    }
}
