<?php
namespace App\Services\Order;

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\Setting;

class OrderProducts {
    public static $orderProductsData = [];
    public static $products = null;
    public static $data = [];
    public static $mailData = [];

    public static function set(array $data){
        self::$data = $data;
        if(is_null(self::$products)){
            $productIds = (array_column($data,'product_id')); // 2
            self::$products = Product::with(['shop:id,name,seller_id','shop.seller:id,name,email'])
            ->select('id','name','price','quantity','shop_id')->whereIn('id',$productIds)->get(); // 2
        }
        return new OrderProducts;
    }

    public function totalPrice()
    {
        $totalPrice = 0;
        foreach(self::$products AS $index=>$product){
            $totalPrice  += ($product->price * self::$data[$index]['quantity']);
        }
        return $totalPrice;
    }

    public function orderProductsData()
    {
        foreach(self::$products AS $index=>$product){
            self::$orderProductsData[$product->id] =
            [
                'price'=>$product->price,
                'quantity'=>self::$data[$index]['quantity'],
            ];
        }
        return self::$orderProductsData;
    }

    public function mailData(int $address_id,Order $newOrder)
    {
        $settings = Setting::first();
        $address = Address::with([
            'user:id,name,email',
            'region:id,name,city_id',
            'region.city:id,name'
        ])->where('id',$address_id)->first();

        self::$mailData['user'] = [
            'id'=>$address->user->id,
            'name'=>$address->user->name,
            'email'=>$address->user->email
        ];
        self::$mailData['address'] = [
            "street"=> $address->street,
            "building"=> $address->building,
            "floor"=> $address->floor,
            "flat"=> $address->flat,
            "notes"=> $address->notes,
            "region"=> $address->region->name,
            "city"=> $address->region->city->name,
        ];

        self::$mailData['settings'] = [
            "phone"=> $settings->phone,
            "email"=> $settings->email,
            "address"=> $settings->address,
            "social_links"=> $settings->social_links,
        ];

        self::$mailData['order'] =  [
            'total_price'=>$newOrder->total_price,
            'final_price'=>$newOrder->final_price,
            'code'=>$newOrder->code,
            'shipping'=>$newOrder->shipping,
            'created_at'=>$newOrder->created_at,
        ];
        foreach(self::$products AS $index=>$product){
            self::$mailData['products'][] =
            [
                'id'=>$product->id,
                'name'=>$product->name,
                'price'=>$product->price,
                'image'=>$product->getFirstMediaPath('products') != "" ? $product->getFirstMediaPath('products') : public_path("assets/admin/images/Default-Product-Image.png") ,
                'quantity'=>self::$data[$index]['quantity'],
                'seller' => [
                    'id'=>$product->shop->seller->id,
                    'name'=>$product->shop->seller->name,
                    'email'=>$product->shop->seller->email
                ],
                'shop' => [
                    'id'=>$product->shop->id,
                    'name'=>$product->shop->name
                ],
            ];
        }
        return self::$mailData;
    }
}
