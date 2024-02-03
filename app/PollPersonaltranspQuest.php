<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollPersonaltranspQuest extends Model
{
    protected $table = 'poll_personaltransp_quest';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order', 'question', 'issue', 'active',
    ];
}
