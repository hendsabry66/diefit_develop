<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class Type
 * @package App\Models
 * @version June 29, 2022, 11:33 am UTC
 *
 */
class Type extends Model
{



    public $table = 'types';


    public $fillable = [
        'price',
        'value',
        'food_type',
        'status',

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
     * Subscription relation
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

}
