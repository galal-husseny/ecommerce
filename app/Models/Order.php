<?php

namespace App\Models;

use App\Http\Controllers\Admin\OrdersController;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    protected $fillable = ['total_price','final_price','code','status'
    ,'payment_id','address_id','coupon_id','shipping'];
    use HasFactory;

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function status() :Attribute
    {
        return Attribute::make(get:fn($value)=>array_search($value,OrdersController::AVAILABLE_STATUS));
    }
}
