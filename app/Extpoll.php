<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extpoll extends Model
{
    protected $table = 'extpolls';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_work', 'id_activity', 'month', 'year', 'p1', 'p2', 'p3', 'p4', 'p5',
    ];
}
