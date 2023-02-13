<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkShift extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['time_start', 'time_end'];
}
