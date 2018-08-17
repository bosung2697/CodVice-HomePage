<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table = 'system';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'classification',
        'images',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
