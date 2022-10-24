<?php

namespace App\Repositories;

use App\Models\SubscriptionOrder;
use App\Repositories\BaseRepository;

/**
 * Class SubscriptionOrderRepository
 * @package App\Repositories
 * @version September 12, 2022, 11:47 am UTC
*/

class SubscriptionOrderRepository extends BaseRepository
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
        return SubscriptionOrder::class;
    }
}
