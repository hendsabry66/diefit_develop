<?php

namespace App\Repositories;

use App\Models\ProductSpecificationCategory;
use App\Repositories\BaseRepository;

/**
 * Class ProductSpecificationCategoryRepository
 * @package App\Repositories
 * @version August 2, 2022, 7:47 pm UTC
*/

class ProductSpecificationCategoryRepository extends BaseRepository
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
        return ProductSpecificationCategory::class;
    }

    /**
     * create a new ProductSpecificationCategory
     */
    public function createProductSpecificationCategory(array $input)
    {
        $input['name']=[
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];

        $productSpecificationCategory = $this->create($input);
        return $productSpecificationCategory;
    }
    /**
     * update a ProductSpecificationCategory
     */
    public function updateProductSpecificationCategory(array $input , $id)
    {
        $input['name']=[
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];
        $productSpecificationCategory = $this->update($input , $id);
        return $productSpecificationCategory;
    }
}
