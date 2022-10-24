<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodImage extends Model
{
    use HasFactory;
    protected $fillable = ['food_id','image'];

    /**
     * image url
     */
    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return \Request::root() . '/uploads/food/' . $value;
        }
    }
}
