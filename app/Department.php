<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Departments extends Model
{
    use SoftDeletes;
    protected $fillable = ['department_name', 'quantity_worker'];
}
