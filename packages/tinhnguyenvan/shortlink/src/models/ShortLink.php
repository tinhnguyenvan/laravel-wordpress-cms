<?php

namespace TinhNguyenVan\ShortLink\Models;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    protected $table = 'short_link';

    protected $fillable = [
        'code',
        'link',
    ];
}
