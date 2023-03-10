<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductionTeam extends Model
{
    use SoftDeletes;
    protected $fillable = ['production_team_name', 'department_id'];

    function department()
    {
        return $this->belongsTo('App\Department');
    }

    function worker()
    {
        return $this->hasMany('App\Worker');
    }

    function productionEquipment()
    {
        return $this->hasMany('App\ProductionEquipment');
    }
}
