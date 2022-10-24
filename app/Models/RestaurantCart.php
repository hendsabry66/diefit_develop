<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'food_id',
        'quantity',
        'price',
    ];

    /**
     * foods
     */
    public function food()
    {
        return $this->belongsTo('App\Models\Food');
    }
}
