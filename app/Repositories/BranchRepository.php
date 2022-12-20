<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Repositories\BaseRepository;

/**
 * Class BranchRepository
 * @package App\Repositories
 * @version June 22, 2022, 11:17 am UTC
*/

class BranchRepository extends BaseRepository
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
        return Branch::class;
    }

    /**
     * create a new Branch
     *
     */
    public function createBranch(array $input)
    {
        $input['name']=[
            'en' => $input['name_en'],
            'ar' => $input['name_ar']
        ];
        $input['address']=[
            'en' => $input['address_en'],
            'ar' => $input['address_ar']
        ];


        $branch = $this->create($input);
        return $branch;
    }

    /**
     * update a Branch
     *
     */
    public function updateBranch(array $input, $id)
    {
        $input['name']=[
            'en' => $input['name_en'],
            'ar' => $input['name_ar']
        ];
        $input['address']=[
            'en' => $input['address_en'],
            'ar' => $input['address_ar']
        ];

        $branch = $this->update($input, $id);
        return $branch;
    }
}
