<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Salary extends Model
{
    use SoftDeletes;
    protected $fillable = ['basic_salary', 'allowance', 'bonus'];

    function worker()
    {
        return $this->hasMany('App\Worker');
    }
}
