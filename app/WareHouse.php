<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WareHouse extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['warehouse_location'];
}
