<?php
namespace App\Services\Order;

use Illuminate\Support\Facades\DB;

class OrderCode {
    public static function generate()
    {
        $newOrderId = DB::select("SELECT COUNT(`id`)+1 AS `new_order_id` FROM `orders` WHERE  DATE_FORMAT(created_at, '%Y-%m-%d')  =  CURDATE() ")[0]->new_order_id;
        $code = date('dmy').$newOrderId;
        return $code;
    }
}
