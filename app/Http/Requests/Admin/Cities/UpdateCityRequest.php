<?php

namespace App\Http\Requests\Admin\Cities;

use App\Http\Controllers\Admin\CitiesController;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
            'name'=>['array:en,ar'],
            'name.en'=>['required','max:32',"unique_translation:cities,name,{$this->city->id},id"],
            'name.ar'=>['required','max:32',"unique_translation:cities,name,{$this->city->id},id"],
            'status'=>['required','in:'.implode(',',CitiesController::AVAILABLE_STATUS)],
        ];
    }
}
