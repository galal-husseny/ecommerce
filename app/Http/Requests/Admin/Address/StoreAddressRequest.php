<?php

namespace App\Http\Requests\Admin\Address;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            "latitude" => ['required','max:20'],
            "longitude" => ['required','max:20'],
            "street" => ['required','max:255'],
            "building" => ['required','max:255'],
            "floor" => ['required','max:255'],
            "flat" => ['required','max:255'],
            "notes" => ['nullable','max:255'],
            "region_id" => ['required','integer','exists:regions,id'],
        ];
    }
}
