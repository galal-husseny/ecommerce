<?php

namespace App\Http\Requests\Apis;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductSearch extends FormRequest
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
            's'=>['nullable','string',''],
            'dir'=>['required_with:sorting_field','nullable','in:asc,desc'],
            'sorting_field'=>['required_with:dir','nullable','in:'.implode(',',(new Product)->fillable)],
            'min_price'=>['required_with:max_price','nullable','numeric','between:1,99999'],
            'max_price'=>['required_with:min_price','nullable','numeric','between:1,99999']
        ];
    }
}
