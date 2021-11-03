<?php

namespace Modules\Purchase\Http\Services;

class PaymentService
{
    static function successPayment($order) {
        return response()->json([
            'message' => 'از خرید شما متشکریم',
            'status' => 201,
            'کد شارژ شما' => $order->product->code
        ]);
    }

    static function failPayment() {
        return response()->json([
            'message' => 'خطایی رخ داده است یا اطلاعات نادرست است',
            'status' => 501
        ]);
    }
}
