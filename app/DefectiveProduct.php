<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefectiveProduct extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['product_id', "can_fix", "error_time", "error_reason"];
}
