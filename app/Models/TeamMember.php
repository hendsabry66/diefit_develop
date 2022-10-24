<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class TeamMember
 * @package App\Models
 * @version June 22, 2022, 11:08 am UTC
 *
 */
class TeamMember extends Model
{

    use HasTranslations;

    public $table = 'team_members';

    public $translatable = ['name' ,'details'];



    public $fillable = [
            'name',
        'details',
        'image',
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
     * image url
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/teamMember/' . $value;
        }
    }

}
