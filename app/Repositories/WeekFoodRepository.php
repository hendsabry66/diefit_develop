<?php

namespace App\Repositories;

use App\Models\WeekFood;
use App\Repositories\BaseRepository;

/**
 * Class WeekFoodRepository
 * @package App\Repositories
 * @version July 3, 2022, 8:09 pm UTC
*/

class WeekFoodRepository extends BaseRepository
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
        return WeekFood::class;
    }
}
