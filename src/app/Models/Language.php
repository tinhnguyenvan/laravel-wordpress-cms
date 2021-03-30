<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Language extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'master_languages';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'status',
        'is_default'
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

    public static function createDefault()
    {
        $lang = [
            'vi' => [
                'name' => '🇻🇳 Việt Nam',
                'status' => 1,
                'is_default' => 1,
            ],
            'en' => [
                'name' => '🇬🇧 English',
                'status' => 0,
                'is_default' => 0,
            ]
        ];

        foreach ($lang as $key => $value) {
            Language::query()->updateOrInsert(
                ['code' => $key],
                [
                    'name' => $value['name'],
                    'status' => $value['status'],
                    'is_default' => $value['is_default'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }

    /**
     * @return array
     */
    public static function loadLanguage(): array
    {
        $keyCache = 'language_content_system';
        $data = Cache::get($keyCache);
        if (empty($data)) {
            $items = Language::query()->where('status', 1)->get(['code', 'name']);
            if ($items->count() > 0) {
                $data = array_column($items->toArray(), 'name', 'code');
                Cache::put($keyCache, $data, now()->addDays(30));
            } else {
                self::createDefault();
                $data['vi'] = '🇻🇳 Việt Nam';
            }
        }

        return $data;
    }
}
