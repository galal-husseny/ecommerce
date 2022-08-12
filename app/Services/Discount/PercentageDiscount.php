<?php
namespace App\Services\Discount;

use App\Models\Coupon;
use App\Services\Discount\Contracts\MustCalculateDiscount;

class PercentageDiscount extends MustCalculateDiscount{
    public function __construct(Coupon $coupon,float $totalPrice)
    {
        $this->coupon = $coupon;
        $this->totalPrice = $totalPrice;
        $this->discountValue = ($this->coupon->discount/100) * $this->totalPrice;
        $this->validateDiscountValue();
        $this->priceAfterDiscount();
    }
    public function details() :array
    {
        return [
            'Totalprice' => $this->totalPrice,
            'discount'=>"{$this->coupon->discount}%",
            'max_discount_value'=>$this->coupon->max_discount_value,
            'discountValue'=>$this->discountValue ,
            'totalPriceAfterDiscount'=> $this->priceAfterDiscount
        ];
    }
    private function validateDiscountValue() :void{
        if($this->discountValue > $this->coupon->max_discount_value){
            $this->discountValue = $this->coupon->max_discount_value;
        }
    }
}

