<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollHostQuest extends Model
{
    protected $table = 'poll_host_quest';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order', 'question', 'issue', 'active', 'recreation',
    ];
}
