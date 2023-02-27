<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Slider;

class CreateSliderRequest extends FormRequest
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
        'title_ar' => 'required',
        'title_en' => 'required',
        'btn_name_ar' => 'required',
        'btn_name_en' => 'required',
        'description_ar' => 'required',
        'description_en' => 'required',
        'link_btn' => 'required',
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
