<?php

namespace App\Repositories;

use App\Models\Type;
use App\Repositories\BaseRepository;

/**
 * Class TypeRepository
 * @package App\Repositories
 * @version June 29, 2022, 11:37 am UTC
*/

class TypeRepository extends BaseRepository
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
        return Type::class;
    }
}
