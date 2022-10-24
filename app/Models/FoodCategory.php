<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class FoodCategory
 * @package App\Models
 * @version June 19, 2022, 8:02 am UTC
 *
 */
class FoodCategory extends Model
{
    use HasTranslations;

    public $table = 'food_categories';

    public $translatable = ['name'];


    public $fillable = [
        'name',
        'status',
        'parent_id',
        'image',
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
     * Get the foods for the food category.
     */
    public function foods()
    {
        return $this->hasMany('App\Models\Food');
    }

    /**
     * Get the children for the food category.
     */
    public function children()
    {
        return $this->hasMany('App\Models\FoodCategory', 'parent_id');
    }
    /**
     * Get the parent for the food category.
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\FoodCategory', 'parent_id');
    }
  /**
     * image url
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/food_category/' . $value;
        }
    }



}
