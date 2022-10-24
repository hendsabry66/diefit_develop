<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Cart
 * @package App\Models
 * @version August 3, 2022, 9:41 pm UTC
 *
 */
class Cart extends Model
{


    public $table = 'carts';




    public $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'specification'


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
     * products
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }


}
