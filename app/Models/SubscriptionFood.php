<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionFood extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'food_id',
        'food_type_id'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

     public function subsrcriptionFoodIngredient()
     {
         return $this->hasMany('App\Models\SubsrcriptionFoodIngredient' , 'subscription_food_id');
     }


}
