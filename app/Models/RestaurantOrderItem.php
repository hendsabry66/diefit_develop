<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOrderItem extends Model
{
    use HasFactory;
    public $fillable = [

        'order_id',
        'food_id',
        'quantity',
        'price',

    ];

    public function restaurantOrder()
    {
        return $this->belongsTo('App\Models\RestaurantOrder');
    }

    public function food()
    {
        return $this->belongsTo('App\Models\Food');
    }
}
