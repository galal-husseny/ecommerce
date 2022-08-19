<?php
namespace App\Services\Discount;

use App\Models\Coupon;
use App\Services\Discount\Contracts\MustCalculateDiscount;

class FixedDiscount extends MustCalculateDiscount{
    public function __construct(Coupon $coupon,float $totalPrice)
    {
        $this->coupon = $coupon;
        $this->totalPrice = $totalPrice;
        $this->discountValue = $this->coupon->discount;
        $this->priceAfterDiscount();
    }
    public function details() :self
    {
        $this->discount = $this->coupon->discount . __('translation.EGP');
        $this->maxDiscountValue = $this->coupon->max_discount_value;
        return $this;
    }

    public function ApiDetails() :array
    {
        return [
            'Totalprice' => $this->totalPrice,
            'discount'=>$this->coupon->discount . __('translation.EGP'),
            'max_discount_value'=>$this->coupon->max_discount_value,
            'discountValue'=> $this->discountValue ,
            'totalPriceAfterDiscount'=> $this->priceAfterDiscount
       ];
    }
}


