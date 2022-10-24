<?php

namespace App\Repositories;

use App\Models\VideoCategory;
use App\Repositories\BaseRepository;

/**
 * Class VideoCategoryRepository
 * @package App\Repositories
 * @version June 19, 2022, 8:14 am UTC
*/

class VideoCategoryRepository extends BaseRepository
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
        return VideoCategory::class;
    }
}
