<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class productionPlant extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['production_plan_nanme'];
}
