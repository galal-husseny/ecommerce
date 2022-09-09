<?php
namespace App\Services\Order;

use App\Jobs\SendAdminOrderInvoice;
use App\Jobs\SendSellersOrderInvoice;
use App\Jobs\SendUserOrderInvoice;
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
        SendUserOrderInvoice::dispatch(self::$mailData)->onQueue('order-mails')->delay(now()->addSeconds(15));
        SendAdminOrderInvoice::dispatch(self::$mailData)->onQueue('order-mails')->delay(now()->addSeconds(15));
        SendSellersOrderInvoice::dispatch(self::$mailData)->onQueue('order-mails')->delay(now()->addSeconds(60));
    }
}
