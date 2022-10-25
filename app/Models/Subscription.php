<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class Subscription
 * @package App\Models
 * @version June 29, 2022, 11:34 am UTC
 *
 */
class Subscription extends Model
{
    use HasTranslations;

    public $table = 'subscriptions';

    public $translatable = ['name' ,'details'];


    public $fillable = [
        'type_id',
        'name',
        'details',
        'price',
        'period',
        'number_of_meals',
        'specialist_price',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * Type relation
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    /**
     * FoodType relation
     */
    public function foodTypes(){
        return $this->belongsToMany(FoodType::class , 'subscription_food_types' , 'subscription_id' , 'food_type_id');
    }
    /**
     * SubscriptionPrice relation
     */
    public function subscriptionPrices()
    {
        return $this->hasMany(SubscriptionPrice::class);
    }




}
