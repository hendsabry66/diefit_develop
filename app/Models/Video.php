<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

use Spatie\Translatable\HasTranslations;

/**
 * Class Video
 * @package App\Models
 * @version June 19, 2022, 8:08 am UTC
 *
 */
class Video extends Model
{
    use HasTranslations;


    public $table = 'videos';

    public $translatable = ['title', 'details','short_description'];


    public $fillable = [
        'title',
        'short_description',
        'details',
        'user_id',
        'status',
        'video',
        'video_category_id',
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
     * Get the user that owns the video.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    /**
     * Get the video category that owns the video.
     */
    public function videoCategory()
    {
        return $this->belongsTo('App\Models\VideoCategory');
    }

    /**
     * Get the video comments that owns the video.
     */
    public function videoComments()
    {
        return $this->hasMany('App\Models\VideoComment');
    }

    public function favourites(){
        return $this->morphMany('App\Models\Favourite', 'favouritable');
    }

    public function getVideoAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/video/' . $value;
        }
    }

}
