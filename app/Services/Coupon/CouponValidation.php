<?php
namespace App\Services\Coupon;

use App\Models\Order;
use App\Models\Coupon;

class CouponValidation {
    private ?Coupon $coupon;
    private int $user_id;
    private float $totalPrice;
    private array $errors = [];
    public function __construct(Coupon $coupon ,int $user_id,float $totalPrice) {
        $this->user_id = $user_id;
        $this->totalPrice = $totalPrice;
        $this->coupon = $coupon;
        $this->wrong()?->expired()?->NotStarted()?->notActive()?->exceedMinOrderPrice()
        ?->exceedMaxUsageCount()?->exceedMaxUsageCountPerUser();

    }
     // 1. wrong coupon
     public function wrong() :?self
     {
         if(is_null($this->coupon)){
             $this->errors[] = __("errors.Not Correct Code");
             return null;
         }
         return $this;
     }
     // 2. expired
     public function expired() :?self
     {
         if(date('Y-m-d H:i:s') > $this->coupon->end_at){
             $this->errors['code'][] = __("errors.Expired Coupon");
             return null;
         }
         return $this;
     }
     // 3. not started
     public function NotStarted() :?self
     {
         if($this->coupon->start_at > date('Y-m-d H:i:s')){
            $this->errors['code'][] = __("errors.Expired Coupon");
            return null;
         }
         return $this;
     }
     // 7. status = 0
     public function notActive() :?self
     {
         if($this->coupon->status == 0){
            $this->errors['code'][] = __("errors.Expired Coupon");
            return null;
         }
         return $this;
     }
     // 6. total price > mini order price
     public function exceedMinOrderPrice() :?self
     {
         if($this->totalPrice < $this->coupon->mini_order_price){
             $this->errors['code'][] = __("errors.Invalid Coupon");
             return null;
         }
         return $this;
     }
     // 4. exceed max usage count
     public function exceedMaxUsageCount()
     {
         $currentlyNumberOfUsage = Order::where('coupon_id',$this->coupon->id)->count();
         if($currentlyNumberOfUsage >= $this->coupon->max_usage_count){
            $this->errors['code'][] = __("errors.Invalid Coupon");
            return null;
         }
         return $this;
     }
     // 5. exceed max usage count per user
     public function exceedMaxUsageCountPerUser()
     {
         $currentlyNumberOfUsagePerUser = Order::join('addresses','orders.address_id','=','addresses.id')
         ->where('coupon_id',$this->coupon->id)
         ->where('user_id',$this->user_id)
         ->count();
         if($currentlyNumberOfUsagePerUser >= $this->coupon->max_usage_count_per_user){
            $this->errors['code'][] = __("errors.Invalid Coupon");
            return null;
         }
         return $this;
     }
     /**
      * Get the value of errors
      */
     public function getErrors() :array
     {
         return $this->errors;
     }

     public function getError() :?string
     {
         return $this->errors['code'][0] ?? null;
     }
    /**
     * Get the value of coupon
     */
    public function getCoupon()
    {
        return $this->coupon;
    }
}
