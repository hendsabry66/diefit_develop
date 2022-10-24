<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Artisan;

/**
 * Class SettingRepository
 * @package App\Repositories
 * @version May 31, 2022, 8:51 pm UTC
*/

class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'setting_group_id',
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
        return Setting::class;
    }

}
