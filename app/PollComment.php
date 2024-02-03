<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollComment extends Model
{
    protected $table = 'poll_comments';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_work', 'month', 'year', 'type', 'comment',
    ];
}
