<?php

namespace App\Repositories;

use App\Models\Video;
use App\Repositories\BaseRepository;

/**
 * Class VideoRepository
 * @package App\Repositories
 * @version June 19, 2022, 8:13 am UTC
*/

class VideoRepository extends BaseRepository
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
        return Video::class;
    }
}
