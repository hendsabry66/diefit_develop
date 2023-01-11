<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class District
 * @package App\Models
 * @version November 22, 2022, 10:42 am UTC
 *
 */
class District extends Model
{
    use HasTranslations;

    public $table = 'districts';

    public $translatable = ['name'];


    public $fillable = [
        'city_id',
        'name',
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
     * City relation
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }


}
