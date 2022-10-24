<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\BaseRepository;

/**
 * Class AddressRepository
 * @package App\Repositories
 * @version August 3, 2022, 10:42 pm UTC
*/

class AddressRepository extends BaseRepository
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
        return Address::class;
    }

    /**
     * create address
     */
    public function createAddress($input)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'city_id' => $input['city_id'],
            'address' => $input['address'],
            'street' => $input['street'],
            'house' => $input['house'],
            'apartment' => $input['apartment']
        ];
        $address = $this->create($data);
        return $address;
    }
}
