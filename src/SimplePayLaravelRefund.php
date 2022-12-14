<?php

namespace zoparga\SimplePayLaravel;

use zoparga\SimplePayLaravel\SDK\SimplePayRefund;
use zoparga\SimplePayLaravel\SDK\SimplePayStart;

class SimplePayLaravelRefund
{
    public $orderRef = '';

    public $transactionId = '';



    public static function prepare()
    {
        return new static;
    }

    public function orderRef($orderRef)
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    public function transactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }


    public function refund()
    {
        $refund = new SimplePayRefund;

        $config = config('simplepay-laravel');
        $refund->addConfig($config);

        //$refund->transactionBase['salt'] = '';
        $refund->transactionBase['merchant'] = config('simplepay-laravel.HUF_MERCHANT');
        $refund->transactionBase['currency'] = 'HUF';
        $refund->transactionBase['orderRef'] = $this->orderRef ?? '';
        $refund->transactionBase['transactionId'] = $this->transactionId;

        $transaction = $refund->runRefund();

        return $transaction;
    }

    // EXAMPLE

    // $transactionId = 502319896;
    // $transaction = (new SimplePayLaravelRefund)->prepare()
    // ->transactionId($transactionId)->giveMeRefund();
    // return $transaction;
}
