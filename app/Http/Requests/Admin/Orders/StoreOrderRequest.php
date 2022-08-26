<?php

namespace App\Http\Requests\Admin\Orders;

use App\Rules\ActiveStatus;
use App\Rules\ValidQuantity;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'products'=>['required','array'],
            'products.*.category_id'=>['required','integer','exists:categories,id'],
            'products.*.brand_id'=>['required_with:products.*.category_id','nullable','integer','exists:brands,id'],
            'products.*.model_id'=>['required_with:products.*.brand_id','nullable','integer','exists:models,id'],
            'products.*.product_id'=>['required_with:products.*.model_id','nullable','integer','exists:products,id',new ActiveStatus('products')],
            'products.*.quantity'=>['required_with:products.*.model_id','nullable','integer','min:1',new ValidQuantity('products','product_id')], // quantity less than DB
            'user_id'=>['required','integer','exists:users,id',new ActiveStatus('users')], // verified
            'address_id'=>['required_with:user_id','integer','exists:addresses,id',new ActiveStatus('addresses')],
            'coupon'=>['nullable','exists:coupons,code'],
            'payment_id'=>['required','integer','exists:payments,id',new ActiveStatus('payments')]
        ];
    }
}
