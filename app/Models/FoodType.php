<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class FoodType
 * @package App\Models
 * @version June 30, 2022, 9:09 am UTC
 *
 */
class FoodType extends Model
{

    use HasTranslations;

    public $table = 'food_types';

    public $translatable = ['name'];



    public $fillable = [
        'name',
        'status'
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

    public function foods()
    {
        return $this->hasMany('App\Models\Food');
    }

    public function weekFoods()
    {
        return $this->hasMany('App\Models\WeekFood');
    }
}
