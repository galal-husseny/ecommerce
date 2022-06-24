<?php

namespace App\Http\Requests\Admin\products;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Admin\ProductsController;

class UpdateProductRequest extends FormRequest
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
            "name" => ['required','array:en,ar'],
            "name.en" => ['required','string','between:2,512'],
            "name.ar" => ['required','string','between:2,512'],
            "price" => ['required','numeric','between:1,999999.99'],
            "quantity" => ['required','numeric','between:1,9999'],
            'status'=>['required','in:'.implode(',',ProductsController::AVAILABLE_STATUS)],
            "category_id" => ['required','integer','exists:categories,id'],
            "model_id" => ['required','integer','exists:models,id'],
            "shop_id" => ['required','integer','exists:shops,id'],
            "description" => ['required','array:en,ar'],
            "description.en" => ['required','string'],
            "description.ar" => ['required','string'],
            "specs" => ['required','array'],
            "specs.*.spec_id" => ['required','integer','exists:specs,id'],
            "specs.*.en" => ['required','string','max:255'],
            "specs.*.ar" => ['required','string','max:255'],
            "images" => ['nullable','array'],
            "images.*.image" => ['nullable','image','mimes:'.implode(',',ProductsController::AVAILABLE_EXTENSIONS),'max:1024'],
            "images.*.width"=>['required_with:images.*.height','nullable','integer','between:50,1080'],
            "images.*.height"=>['required_with:images.*.width','nullable','integer','between:50,1080']

        ];
    }
}
