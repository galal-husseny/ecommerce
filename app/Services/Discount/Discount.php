<?php
namespace App\Services\Discount;

use App\Models\Coupon;
use App\Services\Discount\Contracts\MustCalculateDiscount;

class Discount {
    public static function make(MustCalculateDiscount $MustCalculateDiscount)
    {
        return $MustCalculateDiscount->details();
    }
    public static function makeApi(MustCalculateDiscount $MustCalculateDiscount)
    {
        return $MustCalculateDiscount->ApiDetails();
    }
}


