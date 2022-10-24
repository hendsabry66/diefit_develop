<?php

namespace App\Repositories;

use App\Models\FoodCategory;
use App\Repositories\BaseRepository;
use Image;

/**
 * Class FoodCategoryRepository
 * @package App\Repositories
 * @version June 19, 2022, 8:15 am UTC
*/

class FoodCategoryRepository extends BaseRepository
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
        return FoodCategory::class;
    }

    /**
     * create a new food category
     */
    public function createCategory(array $input)
    {
        $image = $input['image'] ?? null;
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/food_category/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }
        $input['name'] =[
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];
        $category = $this->create($input);
        return $category;
    }

    /**
     * update a food category
     */
    public function updateCategory( array $input ,$id)
    {
        $image = $input['image'] ?? null;
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/food_category/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }
        $input['name'] =[
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];
        $category = $this->update($input,$id);
        return $category;
    }
}
