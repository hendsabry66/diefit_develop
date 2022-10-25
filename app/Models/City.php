<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class City
 * @package App\Models
 * @version May 31, 2022, 8:38 pm UTC
 *
 */
class City extends Model
{
    use SoftDeletes;

    use HasFactory;

    use HasTranslations;

    public $table = 'cities';

    public $translatable = ['name'];

    protected $dates = ['deleted_at'];



    public $fillable = [
        'area_id',
        'name',
        'status',
        'delivery_cost',
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
     * Area relation
     */
    public function area(){
        return $this->belongsTo(Area::class);
    }

    /**
     * ads relation
     */
    public function ads(){
        return $this->hasMany(Ad::class);
    }

    /**
     * branches relation
     */
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

}
