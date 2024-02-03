<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metrotype extends Model
{
    protected $table = 'metrology_types';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code',
    ];
}
