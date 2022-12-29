<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsrcriptionFoodIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_food_id',
        'ingredient',
        'qty',
    ];

    public function subscriptionFood()
    {
        return $this->belongsTo(SubscriptionFood::class);
    }



}
