<?php

namespace App\Http\Requests\Admin\Shop;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
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
            'name'=>['required','string','max:255'],
            'street'=>['required','string','max:255'],
            'building'=>['required','string','max:255'],
            'floor'=>['required','string','max:255'],
            'notes'=>['nullable','string'],
            'latitude'=>['required','numeric'],
            'longitude'=>['required','numeric'],
            'seller_id'=>['required','integer','exists:sellers,id'],
            'region_id'=>['required','integer','exists:regions,id'],
        ];
    }
}
