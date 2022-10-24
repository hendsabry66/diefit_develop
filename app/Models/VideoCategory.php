<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class VideoCategory
 * @package App\Models
 * @version June 19, 2022, 8:07 am UTC
 *
 */
class VideoCategory extends Model
{
    use HasTranslations;


    public $table = 'video_categories';


    public $translatable = ['name'];

    public $fillable = [
        'name',
        'status',
        'parent_id',
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
     * Get the videos for the video category.
     */
    public function videos()
    {
        return $this->hasMany('App\Models\Video');
    }
    /**
     * Get the children for the video category.
     */
    public function children()
    {
        return $this->hasMany('App\Models\VideoCategory', 'parent_id');
    }
    /**
     * Get the parent for the video category.
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\VideoCategory', 'parent_id');
    }

}
