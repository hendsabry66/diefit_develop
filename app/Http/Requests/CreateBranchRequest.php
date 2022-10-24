<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Branch;

class CreateBranchRequest extends FormRequest
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
            'name_en'=>'required',
            'details_ar'=>'required|min:10|max:1000',
            'details_en'=>'required|min:10|max:1000',
            'latitude'=>'required',
            'longitude'=>'required',
            'city_id'=>'required',


        ];
    }
}
