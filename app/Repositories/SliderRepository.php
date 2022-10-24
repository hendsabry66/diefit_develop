<?php

namespace App\Repositories;

use App\Models\Slider;
use App\Repositories\BaseRepository;

/**
 * Class SliderRepository
 * @package App\Repositories
 * @version June 22, 2022, 11:10 am UTC
*/

class SliderRepository extends BaseRepository
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
        return Slider::class;
    }
}
