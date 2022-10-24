<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Address
 * @package App\Models
 * @version August 3, 2022, 9:40 pm UTC
 *
 */
class Address extends Model
{


    public $table = 'addresses';




    public $fillable = [
        'user_id',
        'city_id',
        'address',
        'street',
        'house',
        'apartment'


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


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
