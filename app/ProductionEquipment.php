<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductionEquipment extends Model
{
    use SoftDeletes;
    protected $fillable = ['equipment_name', 'production_team_id', 'status', 'quantity', 'price', 'output_time', 'maintenance_time', 'specifications', 'describe'];

    function productionTeam()
    {
        return $this->belongsTo('App\ProductionTeam');
    }
}
