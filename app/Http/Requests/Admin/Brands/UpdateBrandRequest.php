<?php

namespace App\Http\Requests\Admin\Brands;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Admin\BrandsController;

class UpdateBrandRequest extends FormRequest
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
            // 'name'=>['required','max:32',"unique:brands,name,{$this->brand->id},id"],
            'name'=>['array:en,ar'],
            'name.en'=>['required','max:32'],
            'name.ar'=>['required','max:32'],
            'status'=>['required','in:'.implode(',',BrandsController::AVAILABLE_STATUS)],
            'width'=>['required_with:resize'], //,'integer','between:50,1080'
            'height'=>['required_with:resize'],
        ];
    }
}
