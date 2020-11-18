<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    const TEMPLATE_DEFAULT = 0;
    const TEMPLATE_CONTACT = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'template_id',
        'title',
        'slug',
        'detail',
        'seo_title',
        'seo_description',
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

    public static function link($data)
    {
        $prefix = 'page';

        return $prefix . '/' . $data['slug'];
    }

    public static function dropdownTemplate()
    {
        return [
            self::TEMPLATE_DEFAULT => trans('page.template_default'),
            self::TEMPLATE_CONTACT => trans('page.template_contact'),
        ];
    }

    public function getFormAttribute()
    {
        $data = null;
        if (self::TEMPLATE_CONTACT == $this->template_id) {
            $contactForm = ContactForm::query()->first();

            if (!empty($contactForm->content)) {
                $data = json_decode($contactForm->content);
            }
        }

        return $data;
    }
}
