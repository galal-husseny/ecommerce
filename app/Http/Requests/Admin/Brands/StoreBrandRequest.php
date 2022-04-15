<?php

namespace App\Http\Requests\Admin\Brands;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Admin\BrandsController;

class StoreBrandRequest extends FormRequest
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
            'name'=>['array:en,ar'],
            'name.en'=>['required','max:32','unique_translation:brands'],
            'name.ar'=>['required','max:32','unique_translation:brands'],
            'status'=>['required','in:'.implode(',',BrandsController::AVAILABLE_STATUS)],
            'image'=>['required','max:1024','mimes:'.implode(',',BrandsController::AVAILABLE_EXTENSIONS)],
            'width'=>['required_if:resize,ok','integer','between:50,1080'], //,'integer','between:50,1080'
            'height'=>['required_if:resize,ok','integer','between:50,1080'],
        ];
    }
}
