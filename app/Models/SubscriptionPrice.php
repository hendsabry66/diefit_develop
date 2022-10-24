<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id', 'price', 'food_type'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
