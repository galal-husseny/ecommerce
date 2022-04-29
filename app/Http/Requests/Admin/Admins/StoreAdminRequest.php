<?php

namespace App\Http\Requests\Admin\Admins;

use App\Http\Controllers\Admin\AdminsController;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/", 'confirmed'],
            'password_confirmation' => ['required'],
            'status'=>['required','in:'.implode(',',AdminsController::AVAILABLE_STATUS)],
            'image'=>['nullable','max:1024','mimes:'.implode(',',AdminsController::AVAILABLE_EXTENSIONS)],
            'role_id'=>['required','integer','exists:roles,id'] //,'not_in:1'
        ];
    }
}
