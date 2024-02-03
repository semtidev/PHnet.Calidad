<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollFeedQuest extends Model
{
    protected $table = 'poll_feed_quest';
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
