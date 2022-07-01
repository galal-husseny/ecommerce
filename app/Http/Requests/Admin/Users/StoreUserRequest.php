<?php

namespace App\Http\Requests\Admin\Users;

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'password' => ['required', 'string', "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/", 'confirmed'],
            'password_confirmation' => ['required'],
            'status'=>['required','in:'.implode(',',UsersController::AVAILABLE_STATUS)],
            'email_verified_at'=>['required','in:'.implode(',',UsersController::AVAILABLE_STATUS)],
            'image'=>['nullable','max:1024','mimes:'.implode(',',UsersController::AVAILABLE_EXTENSIONS)],
            'gender'=>['required','in:m,f'],
            'address'=>['required','array:street,flat,floor,building,latitude,longitude,notes,region_id'],
            'address_exist'=>['required','in:true,false'],
            'address.street'=>['required_if:address_exist,true','max:255'],
            'address.flat'=>['required_if:address_exist,true','max:255'],
            'address.floor'=>['required_if:address_exist,true','max:255'],
            'address.building'=>['required_if:address_exist,true','max:255'],
            'address.latitude'=>['required_if:address_exist,true','max:20'],
            'address.longitude'=>['required_if:address_exist,true','max:20'],
            'address.notes'=>['nullable,true','max:255'],
            'address.region_id'=>['required_if:address_exist,true','integer','exists:regions,id'],
        ];
    }
}
