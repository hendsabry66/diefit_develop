<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class ProductSpecificationCategory
 * @package App\Models
 * @version August 2, 2022, 7:46 pm UTC
 *
 */
class ProductSpecificationCategory extends Model
{

    use HasTranslations;

    public $table = 'product_specification_categories';

    public $translatable = ['name'];



    public $fillable = [

        'name',
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
