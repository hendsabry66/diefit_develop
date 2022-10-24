<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class Status
 * @package App\Models
 * @version August 3, 2022, 9:40 pm UTC
 *
 */
class Status extends Model
{
    use HasTranslations;

    public $table = 'statuses';

    public $translatable = ['name'];


    public $fillable = [
            'name'
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
