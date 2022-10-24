<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class WeekFood
 * @package App\Models
 * @version July 3, 2022, 8:09 pm UTC
 *
 */
class WeekFood extends Model
{


    public $table = 'week_foods';




    public $fillable = [
        'food_id',
        'food_type_id',
        'day'


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


}
