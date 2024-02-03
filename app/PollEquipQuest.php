<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollEquipQuest extends Model
{
    protected $table = 'poll_equip_quest';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order', 'question', 'issue',
    ];
}
