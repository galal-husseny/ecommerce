<?php

namespace App\Http\Requests\Admin\Coupons;

use App\Http\Controllers\Admin\CouponsController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCouponRequest extends FormRequest
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
            "code" => ["required","between:2,10","unique:coupons"],
            "discount_type" =>["required","in:f,p"],
            "discount" => ["required","numeric","exclude_if:discount_type,f","between:1,100"],
            "website_percentage" => ["required","integer","between:0,100"],
            'status'=>['required','in:'.implode(',',CouponsController::AVAILABLE_STATUS)],
            'start_at'=>['required','date_format:Y-m-d\TH:i'],
            'end_at'=>['required','date_format:Y-m-d\TH:i','after:start_at'],
            "max_discount_value" => ["required","numeric","exclude_if:discount_type,p",Rule::in([$this->discount])], //,,
            "mini_order_price" => ["nullable","numeric","between:0,999999","exclude_if:discount_type,p","gt:max_discount_value"],
            "max_usage_count" =>  ["nullable","numeric","between:0,999999"],
            "max_usage_count_per_user" => ["required","numeric","between:0,999999"],
        ];
    }

    public function messages()
    {
        return [
            'max_discount_value.in' => 'اقصى قيمة للخصم لابد ان تساوي قيمة الخصم في حالة النسبة الثابتة',
        ];
    }
}
