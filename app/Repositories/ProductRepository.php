<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Image;

/**
 * Class ProductRepository
 * @package App\Repositories
 * @version July 26, 2022, 8:40 pm UTC
*/

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }

    public function getProductsByCategory($id)
    {
        return $this->model->where('product_category_id', $id)->get();
    }

    public function getSimilarProducts($id)
    {
        return $this->model->where('id','!=',$id)->where('product_category_id', $id)->get();
    }

    /**
     * create product
     */
    public function createProduct($input){
        $image = $input['image'] ?? null;
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/product/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }
        $input['name'] =[
                'en' => $input['name_en'],
                'ar' => $input['name_ar']
           ];
        $input['details'] =[
                'en' => $input['details_en'],
                'ar' => $input['details_ar']
           ];
        $product = $this->create($input);
        return $product;
    }

    /**
     * update product
     */
    public function updateProduct($input, $id)
    {
        $image = $input['image'] ?? null;
        if (!empty($image)) {
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/product/';
            $imgName = time() . $image->getClientOriginalName();
            $img = $img->save($imgPath . $imgName);
            $input['image'] = $imgName;
        }
        $input['name'] = [
            'en' => $input['name_en'],
            'ar' => $input['name_ar']
        ];
        $input['details'] = [
            'en' => $input['details_en'],
            'ar' => $input['details_ar']
        ];
        $product = $this->update($input, $id);
        return $product;
    }
    /**
     * getFavoriteProducts
     */
    public function getFavoriteProducts($user_id)
    {
        $products = $this->model->whereHas('favourites', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
        return $products;
    }

}
