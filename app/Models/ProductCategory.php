<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class ProductCategory
 * @package App\Models
 * @version July 26, 2022, 8:38 pm UTC
 *
 */
class ProductCategory extends Model
{

    use HasTranslations;

    public $table = 'product_categories';

    public $translatable = ['name'];



    public $fillable = [
        'name',
        'image',
        'parent_id',
        'status'


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
     * Parent Category
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'parent_id');
    }

    /**
     * Child Categories
     */
    public function children()
    {
        return $this->hasMany('App\Models\ProductCategory', 'parent_id');
    }

    /**
     * Products
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'product_category_id');
    }

    /**
     * image url
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/product_category/' . $value;
        }
    }
}
