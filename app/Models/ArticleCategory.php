<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Translatable\HasTranslations;


/**
 * Class ArticleCategory
 * @package App\Models
 * @version June 19, 2022, 8:02 am UTC
 *
 */
class ArticleCategory extends Model
{
    use HasTranslations;

    public $table = 'article_categories';

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
     * Get the articles for the article category.
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    /**
     * Get the children for the article category.
     */
    public function children()
    {
        return $this->hasMany('App\Models\ArticleCategory', 'parent_id');
    }
    /**
     * Get the parent for the article category.
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\ArticleCategory', 'parent_id');
    }

    /**
     * image url
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/article_category/' . $value;
        }
    }

}
