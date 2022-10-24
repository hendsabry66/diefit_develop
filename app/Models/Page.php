<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Page
 * @package App\Models
 * @version May 31, 2022, 8:40 pm UTC
 *
 */
class Page extends Model
{
    use SoftDeletes;

    use HasFactory;

    use HasTranslations;

    public $table = 'pages';

    public $translatable = ['title', 'details'];

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'details',
        'image',
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

    /**
     * image url
     */
    public function getImageAttribute($value){
        if(!empty($value)){
            return \Request::root().'/uploads/page/'.$value;
        }

    }


}
