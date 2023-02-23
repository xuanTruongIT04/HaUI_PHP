<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductionTeam extends Model
{
    use SoftDeletes;
<<<<<<< HEAD
    protected $fillable = ['production_team_name', 'department_code'];
}
=======
    protected $fillable = ['production_team_name', 'department_id'];

    function department()
    {
        return $this->belongsTo('App\Department');
    }

    function worker()
    {
        return $this->hasMany('App\Worker');
    }
}
>>>>>>> d693082fd433130cc38eff42a34ffc475a914cd4
