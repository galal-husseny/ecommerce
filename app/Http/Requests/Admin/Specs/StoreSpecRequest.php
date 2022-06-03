<?php

namespace App\Http\Requests\Admin\Specs;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecRequest extends FormRequest
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
            'specs.*.en'=>['required','string','max:32'],
            'specs.*.ar'=>['required','string','max:32'],
            'specs.*.category_id'=>['required','array'],
            'specs.*.category_id.*'=>['required','exists:categories,id']
        ];
    }
}
