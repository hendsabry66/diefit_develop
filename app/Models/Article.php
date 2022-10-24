<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class Article
 * @package App\Models
 * @version June 19, 2022, 8:06 am UTC
 *
 */
class Article extends Model
{
    use HasTranslations;

    public $table = 'articles';

    public $translatable = ['title', 'details','short_description'];

    public $fillable = [
        'title',
        'short_description',
        'details',
        'user_id',
        'status',
        'image',
        'article_category_id',

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
     * Get the user that owns the article.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the article category that owns the article.
     */
    public function articleCategory()
    {
        return $this->belongsTo('App\Models\ArticleCategory');
    }
    /**
     * Get the comments for the article.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * image url
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/article/' . $value;
        }
    }

    public function favourites(){
        return $this->morphMany('App\Models\Favourite', 'favouritable');
    }

    /**
     * article comments
     */
    public function articleComments()
    {
        return $this->hasMany('App\Models\ArticleComment');
    }

}
