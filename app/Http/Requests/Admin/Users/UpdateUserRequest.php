<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Admin\UsersController;

class UpdateUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'regex:/^01[0125][0-9]{8}$/', 'unique:users'],
            'password' => ['nullable', 'string', "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/", 'confirmed'],
            'password_confirmation' => ['nullable'],
            'status'=>['required','in:'.implode(',',UsersController::AVAILABLE_STATUS)],
            'email_verified_at'=>['required','in:'.implode(',',UsersController::AVAILABLE_STATUS)],
            'image'=>['nullable','max:1024','mimes:'.implode(',',UsersController::AVAILABLE_EXTENSIONS)],
            'gender'=>['required','in:m,f'],
        ];
    }
}
