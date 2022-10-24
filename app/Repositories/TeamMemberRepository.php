<?php

namespace App\Repositories;

use App\Models\TeamMember;
use App\Repositories\BaseRepository;

/**
 * Class TeamMemberRepository
 * @package App\Repositories
 * @version June 22, 2022, 11:12 am UTC
*/

class TeamMemberRepository extends BaseRepository
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
        return TeamMember::class;
    }
}
