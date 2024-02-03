<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollIssue extends Model
{
    protected $table = 'poll_issues';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_issue', 'id_work', 'month', 'year',
    ];
}
