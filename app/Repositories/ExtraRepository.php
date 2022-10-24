<?php

namespace App\Repositories;

use App\Models\Extra;
use App\Repositories\BaseRepository;

/**
 * Class ExtraRepository
 * @package App\Repositories
 * @version June 26, 2022, 11:04 am UTC
*/

class ExtraRepository extends BaseRepository
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
        return Extra::class;
    }

    /**
     * create a new extra
     */
    public function createExtra(array $input){
        $input['name'] = [
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];
//        $input['details'] = [
//            'en' => $input['details_en'],
//            'ar' => $input['details_ar'],
//        ];
       return  $this->create($input);
    }

    /**
     * update an extra
     */
    public function updateExtra(array $input, $id)
    {
        $input['name'] = [
            'en' => $input['name_en'],
            'ar' => $input['name_ar'],
        ];
//        $input['details'] = [
//            'en' => $input['details_en'],
//            'ar' => $input['details_ar'],
//        ];
        return $this->update($input, $id);
    }
}
