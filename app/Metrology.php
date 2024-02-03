<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metrology extends Model
{
    protected $table = 'metrology';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_work', 'photo', 'id_type', 'id_state', 'name', 'ctdad', 'demand', 'model', 'serie', 'precision', 'limit', 'last_check', 'term_check', 'plan_date', 'real_date', 'result_check', 'reparation', 'next_plan', 'location', 'owner', 'comment', 'active',
    ];
}
