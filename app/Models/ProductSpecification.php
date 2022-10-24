<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class ProductSpecification
 * @package App\Models
 * @version August 2, 2022, 7:45 pm UTC
 *
 */
class ProductSpecification extends Model
{
    use HasTranslations;


    public $table = 'product_specifications';


    public $translatable = ['value'];


    public $fillable = [
        'product_id',
        'product_specification_category_id',
        'value',

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
     * product_specification_category_id
     */
    public function product_specification_category()
    {
        return $this->belongsTo(ProductSpecificationCategory::class, 'product_specification_category_id');
    }

    /**
     * product_id
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
