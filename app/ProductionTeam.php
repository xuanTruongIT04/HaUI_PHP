<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductionTeam extends Model
{
    use SoftDeletes;
    protected $fillable = ['production_team_name', 'department_id'];
}
