<?php

namespace App\Services;

class PayHereService
{
    public static function generateHash($merchantId, $orderId, $amount, $currency, $merchantSecret)
    {
        $hash = strtoupper(
            md5(
                $merchantId .
                $orderId .
                number_format($amount, 2, '.', '') .
                $currency .
                strtoupper(md5($merchantSecret))
            )
        );

        return $hash;
    }
}
