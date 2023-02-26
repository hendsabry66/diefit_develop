<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class Product
 * @package App\Models
 * @version July 26, 2022, 8:37 pm UTC
 *
 */
class Product extends Model
{

    use HasTranslations;

    public $table = 'products';


    public $translatable = ['name', 'details'];


    public $fillable = [
        'name',
        'details',
        'image',
        'price',
        'qty',
        'product_category_id'


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
     * Product Category
     */
    public function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id');
    }

    /**
     * image url
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/product/' . $value;
        }
    }

    /**
     * Product Images
     */
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id');
    }
    /**
     * Product Favourites
     */
    public function favourites(){
        return $this->morphMany('App\Models\Favourite', 'favouritable');
    }

    /**
     * product Specifications
     */
    public function specifications()
    {
        return $this->hasMany('App\Models\ProductSpecification', 'product_id');
    }
       /**
        * product category specifications
        */
         public function categorySpecifications($product_id){
             $data = [];

             foreach ($this->specifications()->where('product_id',$product_id)->get() as $specification) {

                 array_push($data, $specification->product_specification_category);
             }
                return $data;

         }

    /**
     * product Orders
     */
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'order_items', 'product_id', 'order_id');
    }

}
