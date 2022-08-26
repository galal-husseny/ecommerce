<?php
namespace App\Services\Coupon;

use App\Services\Coupon\CouponValidation;
use App\Models\Coupon AS CouponModel;
class Coupon {
    public static function validate(CouponModel $coupon ,int $user_id,float $totalPrice) :?string
    {
        return (new CouponValidation($coupon ,$user_id,$totalPrice))->getError();
    }
    public static function validateApi(CouponModel $coupon ,int $user_id,float $totalPrice) :array
    {
        return (new CouponValidation($coupon ,$user_id,$totalPrice))->getErrors();
    }
}
