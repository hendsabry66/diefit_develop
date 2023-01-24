<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionSnack extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'food_id',
        'price',
    ];
    //food
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
