<?php

namespace App\Http\Requests\Admin\Specs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpecRequest extends FormRequest
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
            'name'=>['required','array:en,ar'],
            'name.en'=>['required','string','max:32'],
            'name.ar'=>['required','string','max:32'],
            'category_id'=>['required','array'],
            'category_id.*'=>['required','exists:categories,id']
        ];
    }
}
