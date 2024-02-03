<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetroHistory extends Model
{
    protected $table = 'metrology_history';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tool', 'action', 'action_date', 'project', 'owner',
    ];
}
