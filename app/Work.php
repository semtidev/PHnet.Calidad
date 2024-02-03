<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'works';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'abbr', 'metrology', 'planning', 'intcustomerpoll', 'extcustomerpoll', 'active',
    ];
}
