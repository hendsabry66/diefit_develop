<?php

namespace App\Repositories;

use App\Models\FoodType;
use App\Repositories\BaseRepository;

/**
 * Class FoodTypeRepository
 * @package App\Repositories
 * @version June 30, 2022, 9:10 am UTC
*/

class FoodTypeRepository extends BaseRepository
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
        return FoodType::class;
    }
    /**
     * create new food type
     */
    public function createFoodType($input)
    {
       $input['name'] =[
              'en' => $input['name_en'],
              'ar' => $input['name_ar']
         ];

        $foodType = $this->create($input);
        return $foodType;
    }
    /**
     * update food type
     */
    public function updateFoodType($input, $id)
    {
        $input['name'] =[
              'en' => $input['name_en'],
              'ar' => $input['name_ar']
         ];
        $foodType = $this->update($input, $id);
        return $foodType;
    }

}
