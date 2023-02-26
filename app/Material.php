<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Material extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['material_name', 'material_desc', 'qty_import', 'qty_broken', 'qty_remain', 'price_import', 'date_import', 'unit_of_measure', 'material_status', 'stage_id', 'image_id'];
}
