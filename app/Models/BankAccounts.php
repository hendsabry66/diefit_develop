<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class BankAccounts
 * @package App\Models
 * @version August 22, 2022, 10:39 am UTC
 *
 */
class BankAccounts extends Model
{


    public $table = 'bank_accounts';




    public $fillable = [
        'bank_name',
        'account_number',
        'account_iban',
        'swift_code',
        'status'


    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
