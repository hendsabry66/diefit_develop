<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'subscription_price_id', 'user_id', 'status_id', 'payment',
        'name', 'account_number', 'amount', 'ipan','bank_id','image' , 'start_date' , 'end_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function subscriptionPrice()
    {
        return $this->belongsTo(SubscriptionPrice::class, 'subscription_price_id');
    }

    public function subscriptionOrderFood()
    {
        return $this->hasMany(SubscriptionOrderFood::class);
    }
}