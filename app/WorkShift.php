<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkShift extends Model
{
  //
  use SoftDeletes;
  protected $fillable = ['work_shift_code', 'time_start', 'time_end'];
}
