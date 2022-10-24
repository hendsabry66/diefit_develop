<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Setting
 * @package App\Models
 * @version May 31, 2022, 8:43 pm UTC
 *
 */
class Setting extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'settings';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'value',
        'key',
        'setting_group_id',
        'type',
        'description',


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
     * Get setting group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function setting_group()  {
        return $this->belongsTo(SettingGroup::class);
    }



}
