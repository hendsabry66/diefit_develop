<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOrder extends Model
{
    use HasFactory;
    public $fillable = [

        'user_id',
        'address_id',
        'status_id',
        'total_price',
        'price',
        'delivery',
        'tax',
        'delivery_date',
        'delivery_time',
        'payment',
      'payment_status',

    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
    public function restaurantOrderItems()
    {
        return $this->hasMany('App\Models\RestaurantOrderItem','order_id');
    }
}
