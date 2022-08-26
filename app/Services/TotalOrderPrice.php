<?php
namespace App\Services;

use App\Models\Product;

class TotalOrderPrice {
    public static $productsData = [];
    public static function get(array $data)
    {
        // 2
        $totalPrice = 0;
        $productIds = (array_column($data,'product_id')); // 2
        $products = Product::select('id','price','quantity')->whereIn('id',$productIds)->get(); // 2
        self::$productsData = [];
        foreach($products AS $index=>$product){
            $totalPrice  += ($product->price * $data[$index]['quantity']);
            self::$productsData[$product->id] = ['price'=>$product->price,'quantity'=>$data[$index]['quantity']];
        }
        return $totalPrice;
    }
}
