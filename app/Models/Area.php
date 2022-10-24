<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Area
 * @package App\Models
 * @version May 31, 2022, 8:38 pm UTC
 *
 */
class Area extends Model
{
    use SoftDeletes;

    use HasFactory;

    use HasTranslations;

    public $table = 'areas';

    public $translatable = ['name'];

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'status',

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
     * ads relation
     */
    public function ads(){
        return $this->hasMany(Ad::class);
    }

    /**
     * city relation
     */
    public function cities(){
        return $this->hasMany(City::class);
    }

}
