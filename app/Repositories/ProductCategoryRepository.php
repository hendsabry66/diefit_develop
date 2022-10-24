<?php

namespace App\Repositories;

use App\Models\ProductCategory;
use App\Repositories\BaseRepository;

/**
 * Class ProductCategoryRepository
 * @package App\Repositories
 * @version July 26, 2022, 8:39 pm UTC
*/

class ProductCategoryRepository extends BaseRepository
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
        return ProductCategory::class;
    }

    /**
     * create new product category
     */
    public function createProductCategory($input){
        $data = $input;
        $image =  $input['image'];
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/product_category/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $data['image']=$imgName;
        }
        $data['name'] =[
               'en' => $input['name_en'],
               'ar' => $input['name_ar']
          ];
        $productCategory = $this->create($data);
        return $productCategory;
    }
    /**
     * update product category
     */
    public function updateProductCategory($input, $id)
    {
        $image = $input['image'];
        $data = $input;
        if (!empty($image)) {
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/product_category/';
            $imgName = time() . $image->getClientOriginalName();
            $img = $img->save($imgPath . $imgName);
            $data['image'] = $imgName;
        }
        $data['name'] = [
            'en' => $input['name_en'],
            'ar' => $input['name_ar']
        ];
        $productCategory = $this->update($data, $id);
        return $productCategory;
    }
}
