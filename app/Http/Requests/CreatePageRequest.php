<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Page;

class CreatePageRequest extends FormRequest
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
            'title_ar' => 'required|string|min:2|max:50',
            'details_ar' => 'required|min:10|max:1000',
            'title_en' => 'required|string|min:2|max:50',
            'details_en' => 'required|min:10|max:1000',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
