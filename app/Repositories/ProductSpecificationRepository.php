<?php

namespace App\Repositories;

use App\Models\ProductSpecification;
use App\Repositories\BaseRepository;

/**
 * Class ProductSpecificationRepository
 * @package App\Repositories
 * @version August 2, 2022, 7:47 pm UTC
*/

class ProductSpecificationRepository extends BaseRepository
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
        return ProductSpecification::class;
    }

    /**
     * create a new ProductSpecification
     */
    public function createProductSpecification(array $input)
    {
        $input['value']=[
            'en' => $input['value_en'],
            'ar' => $input['value_ar']
        ];

        $productSpecification = $this->create($input);
        return $productSpecification;
    }
    /**
     * update a ProductSpecification
     */
    public function updateProductSpecification(array $input , $id){
        $input['value']=[
            'en' => $input['value_en'],
            'ar' => $input['value_ar']
        ];
        $productSpecification = $this->update($input , $id);
        return $productSpecification;
    }
}
