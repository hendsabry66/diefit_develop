<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Extra;

class UpdateExtraRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
           // 'price' => 'required|numeric',
//            'details_ar' => 'required',
//            'details_en' => 'required',
            'numberOfCalories' => 'required|numeric',
            'fat_percentage' => 'required|numeric',
            'protein_percentage' => 'required|numeric',
            'carbohydrate_percentage' => 'required|numeric',

        ];
    }
}
