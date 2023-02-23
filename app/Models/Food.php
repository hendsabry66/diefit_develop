<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class Food
 * @package App\Models
 * @version June 23, 2022, 11:25 am UTC
 *
 */
class Food extends Model
{
    use HasTranslations;

    public $table = 'foods';

    public $translatable = ['name', 'details','ingredients'];


    public $fillable = [
        'name',
        'details',
        'image',
        'price',
        'numberOfCalories',
        'ingredients',
        'qty',
        'food_category_id',
        'fat_percentage',
        'protein_percentage',
        'carbohydrate_percentage',
        'status',
        'saturated_fat',
        'trans_fats',
        'cholestrol',
        'sodium',
        'fiber',
        'sugars',


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
     * Get the food category that owns the food.
     */
    public function foodCategory()
    {
        return $this->belongsTo('App\Models\FoodCategory');
    }

    /**
     * image url
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/food/' . $value;
        }
    }
    /**
     * Get the food extra that owns the food.
     */
    public function extras()
    {
        return $this->belongsToMany('App\Models\Extra', 'food_extra', 'food_id', 'extra_id');
    }

    /**
     * Product Favourites
     */
    public function favourites(){
        return $this->morphMany('App\Models\Favourite', 'favouritable');
    }

    /**
     * food Images
     */
    public function images()
    {
        return $this->hasMany('App\Models\FoodImage', 'food_id');
    }

    /*
     * subscriptions
     */
    public function subscriptions(){
        return $this->belongsToMany('App\Models\Subscription', 'subscription_foods', 'food_id', 'subscription_id');
    }
    /*
     * ingredients
     */
    public function ingredients()
    {
        return $this->hasMany('App\Models\SubsrcriptionFoodIngredient', 'food_id');
    }

}
