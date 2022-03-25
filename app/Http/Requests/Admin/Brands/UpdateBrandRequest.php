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
            'name'=>['required','max:32',"unique:brands,name,{$this->id},id"],
            'status'=>['required','in:'.implode(',',BrandsController::AVAILABLE_STATUS)]
        ];
    }
}
