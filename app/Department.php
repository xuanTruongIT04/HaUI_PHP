<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{
    use SoftDeletes;
    protected $fillable = ['department_name'];

    function productionTeam()
    {
        return $this->hasMany('App\ProductionTeam');
    }

    function worker()
    {
        return $this->hasMany('App\Worker');
    }
}
