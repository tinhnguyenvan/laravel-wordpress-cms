<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cache extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cache';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['key', 'value', 'expiration'];
}
