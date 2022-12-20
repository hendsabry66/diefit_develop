<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class Branch
 * @package App\Models
 * @version June 22, 2022, 11:05 am UTC
 *
 */
class Branch extends Model
{

    use HasTranslations;

    public $table = 'branches';

    public $translatable = ['name' ,'address'];



    public $fillable = [
        'name',
        'address',
        'city_id',
        'district_id',
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

    /**
     * city relation
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * district relation
     */

    public function district()
    {
        return $this->belongsTo(District::class);
    }



}
