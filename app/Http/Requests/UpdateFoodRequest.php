<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Food;

class UpdateFoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|unique:foods,name',
            'name_en' => 'required|unique:foods,name',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ingredients_ar' => 'required|min:10',
            'ingredients_en' => 'required|min:10',
            'details_ar' => 'required|min:10',
            'details_en' => 'required|min:10',
            'numberOfCalories' => 'required|numeric',
            'qty' => 'required|numeric',
            'food_category_id' => 'required',
            'fat_percentage' => 'required|numeric',
            'protein_percentage' => 'required|numeric',
            'carbohydrate_percentage' => 'required|numeric',


        ];
    }
}
