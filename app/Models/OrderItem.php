<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class OrderItem
 * @package App\Models
 * @version August 3, 2022, 9:39 pm UTC
 *
 */
class OrderItem extends Model
{


    public $table = 'order_items';




    public $fillable = [

        'order_id',
        'product_id',
        'quantity',
        'price',
        'specification',

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

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
