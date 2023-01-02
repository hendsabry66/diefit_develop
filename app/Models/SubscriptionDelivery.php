<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'number_of_delivery_days',
        'period',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
