<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['product_code', 'product_name', 'slug', 'product_desc', 'product_detail', 'product_status', 'price_old', 'price_new', 'qty_sold', 'qty_remain', 'qty_broken', 'sold_most'];

    
    function image() {
        return $this->hasMany('App\Image');
    }


    function order() {
        return $this->belongsToMany('App\Order');
    } 

    function orderProduct() {
        return $this->hasMany('App\OrderProduct');
    } 
}
