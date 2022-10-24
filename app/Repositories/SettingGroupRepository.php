<?php

namespace App\Repositories;

use App\Models\SettingGroup;
use App\Repositories\BaseRepository;

/**
 * Class SettingGroupRepository
 * @package App\Repositories
 * @version May 31, 2022, 8:51 pm UTC
*/

class SettingGroupRepository extends BaseRepository
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
        return SettingGroup::class;
    }
}
