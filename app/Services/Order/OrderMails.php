<?php
namespace App\Services\Order;

use App\Mail\OrderAdminMail;
use App\Mail\OrderUserMail;
use Illuminate\Support\Facades\Mail;

class OrderMails {
    public static $mailData;
    public static function set($mailData)
    {
        self::$mailData = $mailData;
        return new self;
    }

    public function sendMails()
    {
        Mail::to(self::$mailData['user']['email'])->send(new OrderUserMail(self::$mailData));
        Mail::to(self::$mailData['settings']['email'])->send(new OrderAdminMail(self::$mailData));
        // mail to sellers
    }
}
