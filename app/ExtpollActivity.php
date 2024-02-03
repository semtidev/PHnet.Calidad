<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtpollActivity extends Model
{
    protected $table = 'extpoll_activities';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_speciality', 'description', 'act_level',
    ];
}
