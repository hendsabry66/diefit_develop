<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Order
 * @package App\Models
 * @version August 3, 2022, 9:39 pm UTC
 *
 */
class Order extends Model
{


    public $table = 'orders';




    public $fillable = [

        'user_id',
        'address_id',
        'status_id',
        'total_price',
        'price',
        'delivery',
        'tax',
        'delivery_date',
        'delivery_time',
        'payment',
      'payment_status',

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
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

}
