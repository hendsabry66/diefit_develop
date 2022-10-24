<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class Extra
 * @package App\Models
 * @version June 26, 2022, 11:03 am UTC
 *
 */
class Extra extends Model
{

    use HasTranslations;

    public $table = 'extras';

    public $translatable = ['name'];


    public $fillable = [
        'name',
        'details',
        'price',
        'has_price',
        'numberOfCalories',
        'fat_percentage',
        'protein_percentage',
        'carbohydrate_percentage',
        'qty'
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
     * Get the food that owns the
     * extra.
     */
    public function foods()
    {
        return $this->belongsToMany(Food::class);
    }

    public function values()
    {
        return $this->hasMany(ExtraValue::class);
    }

}
