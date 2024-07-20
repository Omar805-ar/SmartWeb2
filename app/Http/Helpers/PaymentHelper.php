<?php

namespace App\Http\Helpers;
use Nafezly\Payments\Classes\TapPayment;

trait PaymentHelper
{
    public function tap($order,$amount,$merchant_id)
    {
        $payment = new TapPayment();
        $res = $payment->pay(
            $amount,
            $user_id            = $merchant_id,
            $user_first_name    = $order['formData']['first_name'],
            $user_last_name     = $order['formData']['last_name'],
            $user_email         = $order['formData']['email'],
            $user_phone         = $order['formData']['phone'],
        );

        return $res;
    }
    public function tap2($order,$amount,$merchant_id)
    {
        $name = trim($order->name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );

        $payment = new TapPayment();
        $res = $payment->pay(
            $amount,
            $user_id            = $merchant_id,
            $user_first_name    = $last_name,
            $user_last_name     = $last_name,
            $user_email         = $order->email,
            $user_phone         = $order->phone,
        );

        return $res;
    }
    
}
