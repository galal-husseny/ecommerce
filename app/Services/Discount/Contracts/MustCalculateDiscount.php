<?php
namespace App\Services\Discount\Contracts;

use App\Models\Coupon;

abstract class MustCalculateDiscount {
    public float $priceAfterDiscount;
    public float $totalPrice;
    public float $discountValue;
    public string $discount;
    public float $maxDiscountValue;
    public Coupon $coupon;
    protected abstract function __construct(Coupon $coupon,float $totalPrice);
    protected abstract function details() :self;
    protected abstract function ApiDetails() :array;
    protected function priceAfterDiscount() :void
    {
        $this->priceAfterDiscount = $this->totalPrice - $this->discountValue;
    }
}


