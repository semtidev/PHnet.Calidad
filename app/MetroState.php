<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetroState extends Model
{
    protected $table = 'metrology_states';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state',
    ];
}
