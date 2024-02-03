<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollFeed extends Model
{
    protected $table = 'poll_feed';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'id_work', 'month', 'year', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', /*'q7',*/
    ];
}
