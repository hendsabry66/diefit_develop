<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SettingGroup
 * @package App\Models
 * @version May 31, 2022, 8:42 pm UTC
 *
 */
class SettingGroup extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'setting_groups';


    protected $dates = ['deleted_at'];



    public $fillable = [

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
     * Get setting
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function app_settings()  {
        return $this->hasMany(Setting::class);
    }
}
