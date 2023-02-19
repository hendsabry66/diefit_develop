<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionFoodType extends Model
{
    use HasFactory;
    protected $fillable = [
        'subscription_delivery_id',
        'subscription_id'
    ];
}
