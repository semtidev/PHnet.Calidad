<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetroPlanHistory extends Model
{
    protected $table = 'metrology_plan_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tool', 'plan_date', 'real_date', 'id_user',
    ];
}
