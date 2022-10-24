<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionOrderFood extends Model
{
    use HasFactory;

    public $table = 'subscription_order_foods';

    public $fillable = [
        'subscription_order_id',
        'subscription_price_id',
        'user_id',
        'day',
        'food_type_id',
        'food_id',

    ];

    public function subscriptionOrder()
    {
        return $this->belongsTo(SubscriptionOrder::class);
    }

    public function subscriptionPrice()
    {
        return $this->belongsTo(SubscriptionPrice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foodType()
    {
        return $this->belongsTo(FoodType::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
