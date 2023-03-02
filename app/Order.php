<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['order_code', 'address_delivery', 'payment_method', 'notes', 'order_status', "customer_id" ];
    // protected $fillable = ['order_code', 'address_delivery', 'time_order', 'time_export' 'payment_method', 'notes', 'order_status', "customer_id" ];

    function customer() {
        return $this->belongsTo('App\Customer');
    } 

    function product() {
        return $this->belongsToMany('App\Product');
    }

    function orderProduct() {
        return $this->hasMany('App\OrderProduct');
    }
   
}
