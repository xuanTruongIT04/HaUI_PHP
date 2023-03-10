<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stage extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['stage_name', 'stage_detail', 'order',"finished_product"];

}
