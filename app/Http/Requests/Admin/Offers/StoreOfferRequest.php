<?php

namespace App\Http\Requests\Admin\Offers;

use App\Http\Controllers\Admin\OffersController;
use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            "title" => ['required','array:en,ar'],
            "title.en" => ['required','string','between:2,512'],
            "title.ar" => ['required','string','between:2,512'],
            "max_discount" => ['required','numeric','between:1,100'],
            'status'=>['required','in:'.implode(',',OffersController::AVAILABLE_STATUS)],
            'start_at'=>['required','date_format:Y-m-d\TH:i'],
            'end_at'=>['required','date_format:Y-m-d\TH:i','after:start_at'],
            "description" => ['required','array:en,ar'],
            "description.en" => ['nullable','string'],
            "description.ar" => ['nullable','string'],
            "products" => ['required','array'],
            "products.*.product_id" => ['required_with:products.*.discount','nullable','integer','exists:products,id'],
            "products.*.discount" => ['required_with:products.*.product_id','nullable','numeric','between:1,100'],
            "image" => ['nullable','image','mimes:'.implode(',',OffersController::AVAILABLE_EXTENSIONS),'max:1024'],
        ];
    }
}
