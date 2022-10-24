<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class Slider
 * @package App\Models
 * @version June 22, 2022, 11:09 am UTC
 *
 */
class Slider extends Model
{
    use HasTranslations;


    public $table = 'sliders';

    public $translatable = ['text'];


    public $fillable = [
        'image',
        'text',
        'link',
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
     * image url
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/slider/' . $value;
        }
    }


}
