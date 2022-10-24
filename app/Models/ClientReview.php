<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class ClientReview
 * @package App\Models
 * @version June 22, 2022, 11:02 am UTC
 *
 */
class ClientReview extends Model
{


    use HasTranslations;

    public $table = 'client_reviews';

    public $translatable = ['name' ,'details'];


    public $fillable = [
        'name',
        'details',
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
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/clientReview/' . $value;
        }
    }

}
