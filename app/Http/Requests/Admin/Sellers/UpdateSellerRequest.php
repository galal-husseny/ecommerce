<?php

namespace App\Http\Requests\Admin\Sellers;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Admin\SellersController;

class UpdateSellerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:sellers,email,{$this->seller->id},id"],
            'phone' => ['required', 'regex:/^01[0125][0-9]{8}$/',  "unique:sellers,phone,{$this->seller->id},id"],
            'national_id'=>['required','integer','digits:14', "unique:sellers,national_id,{$this->seller->id},id"],
            'password' => ['nullable', 'string', "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/", 'confirmed'],
            'status'=>['required','in:'.implode(',',SellersController::AVAILABLE_STATUS)],
            'email_verified_at'=>['required','in:'.implode(',',SellersController::AVAILABLE_STATUS)],
            'image'=>['nullable','max:1024','mimes:'.implode(',',SellersController::AVAILABLE_EXTENSIONS)],
            'gender'=>['required','in:m,f'],
            'social_links'=>['nullable','array'],
            'social_links.*.social_link'=>['nullable','url','starts_with:http://,https://']
        ];
    }
}
