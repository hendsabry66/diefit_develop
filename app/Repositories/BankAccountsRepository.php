<?php

namespace App\Repositories;

use App\Models\BankAccounts;
use App\Repositories\BaseRepository;

/**
 * Class BankAccountsRepository
 * @package App\Repositories
 * @version August 22, 2022, 10:40 am UTC
*/

class BankAccountsRepository extends BaseRepository
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
        return BankAccounts::class;
    }
}
