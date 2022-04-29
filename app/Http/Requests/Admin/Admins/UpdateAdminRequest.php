<?php

namespace App\Http\Requests\Admin\Admins;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Admin\AdminsController;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if the updated user isn't a super admin
        // if($this->admin->getRoleNames()->toArray()[0] != "Super Admin"){
        //     return true;
        // }
        // // if the updated user is a super admin and the authenticated user a super admin
        // if($this->admin->getRoleNames()->toArray()[0] == "Super Admin"  && $this->user('admin')->getRoleNames()->toArray()[0] == "Super Admin"){
        //     return true;
        // }
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
            'email' => ['required', 'string', 'email', 'max:255', "unique:admins,email,{$this->admin->id},id"],
            'password' => ['nullable', 'string', "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/", 'confirmed'],
            'status'=>['required','in:'.implode(',',AdminsController::AVAILABLE_STATUS)],
            'image'=>['nullable','max:1024','mimes:'.implode(',',AdminsController::AVAILABLE_EXTENSIONS)],
            'role_id'=>['required','integer','exists:roles,id',] // 'not_in:1'
        ];
    }
}
