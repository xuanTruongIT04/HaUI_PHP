<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionPlan extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['name_role'];

 
}
