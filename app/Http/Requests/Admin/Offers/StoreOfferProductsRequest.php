<?php

namespace App\Http\Requests\Admin\Offers;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferProductsRequest extends FormRequest
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
            "offer_id" => ['required','integer','exists:offers,id'],
            "products" => ['required','array'],
            "products.*.offer_id" => ['required','integer','exists:offers,id'],
            "products.*.product_id" => ['required','integer','exists:products,id'],
            "products.*.discount" => ['required','numeric','between:1,100'],
        ];
    }
}
