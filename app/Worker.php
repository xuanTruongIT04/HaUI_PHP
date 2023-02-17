<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;
    protected $fillable = ['worker_name', 'old', 'address', 'number_of_working_days', 'number_of_overtime', 'salary_id', 'department_id', 'work_shift_id'];

    function department()
    {
        return $this->belongsTo('App\Department');
    }

    function salary()
    {
        return $this->belongsTo('App\Salary');
    }

    function workShift()
    {
        return $this->belongsTo('App\WorkShift');
    }
}
