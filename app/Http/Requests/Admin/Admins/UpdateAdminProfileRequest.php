<?php

namespace App\Http\Requests\Admin\Admins;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Admin\AdminsController;

class UpdateAdminProfileRequest extends FormRequest
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
            'image'=>['nullable','max:1024','mimes:'.implode(',',AdminsController::AVAILABLE_EXTENSIONS)],
        ];
    }
}
