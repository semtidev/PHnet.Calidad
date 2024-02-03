<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollIssueDesc extends Model
{
    protected $table = 'poll_issue_desc';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'type',
    ];
}
