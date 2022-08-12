<?php
namespace App\Services\Discount\Contracts;

use App\Models\Coupon;

abstract class MustCalculateDiscount {
    protected float $priceAfterDiscount;
    protected float $totalPrice;
    protected float $discountValue;
    protected Coupon $coupon;
    protected abstract function __construct(Coupon $coupon,float $totalPrice);
    protected abstract function details() :array;
    protected function priceAfterDiscount() :void
    {
        $this->priceAfterDiscount = $this->totalPrice - $this->discountValue;
    }
}


