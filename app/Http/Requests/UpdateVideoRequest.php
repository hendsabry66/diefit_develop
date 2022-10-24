<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Video;

class UpdateVideoRequest extends FormRequest
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
            'short_description_ar' => 'required|min:10',
            'short_description_en' => 'required|min:10',
            'details_ar' => 'required|min:10',
            'details_en' => 'required|min:10',
           // 'video_category_id' => 'required',
        ];
    }
}
