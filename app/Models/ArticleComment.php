<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'parent_id',
        'user_id',
        'article_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

}
