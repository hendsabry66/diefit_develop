<?php

namespace App\Repositories;

use App\Models\Food;
use App\Repositories\BaseRepository;
use Image;

/**
 * Class FoodRepository
 * @package App\Repositories
 * @version June 23, 2022, 12:49 pm UTC
*/

class FoodRepository extends BaseRepository
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
        return Food::class;
    }

    /**
     * create a new food
     */
    public function createFood(array $input){
        $image = $input['image'] ?? null;
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/food/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }

        $input['name'] = [
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];

        $input['ingredients'] = [
            'en' => $input['ingredients_en'],
            'ar' => $input['ingredients_ar'],
        ];

        $input['details'] = [
            'en' => $input['details_en'],
            'ar' => $input['details_ar'],
        ];

        $food = $this->create($input);
        return $food;
    }

    /**
     * update a food
     */
    public function updateFood(array $input, $id)
    {
        $image = $input['image'] ?? null;
        if (!empty($image)) {
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/food/';
            $imgName = time() . $image->getClientOriginalName();
            $img = $img->save($imgPath . $imgName);
            $input['image'] = $imgName;
        }

        $input['name'] = [
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];
        $input['ingredients'] = [
            'en' => $input['ingredients_en'],
            'ar' => $input['ingredients_ar'],
        ];
        $input['details'] = [
            'en' => $input['details_en'],
            'ar' => $input['details_ar'],
        ];
        $food = $this->update($input, $id);
        return $food;
    }

    public function getFavoriteProducts($user_id)
    {
        $foods = $this->model->whereHas('favourites', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
        return $foods;
    }
}
