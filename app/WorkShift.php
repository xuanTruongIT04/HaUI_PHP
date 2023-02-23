<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkShift extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['time_start', 'time_end'];
<<<<<<< HEAD
}
=======

    function worker()
    {
        return $this->hasMany('App\Worker');
    }
}
>>>>>>> d693082fd433130cc38eff42a34ffc475a914cd4
