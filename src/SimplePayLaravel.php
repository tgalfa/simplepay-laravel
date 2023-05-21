<?php

namespace zoparga\SimplePayLaravel;

use zoparga\SimplePayLaravel\SDK\SimplePayStart;

class SimplePayLaravel
{
    public $language = 'HU';

    public $currency = 'HUF';

    public $totalPrice = 300;

    public $email = 'sdk_test@otpmobil.com';

    public $name = 'SimplePay V2 Tester';

    public $company = '';

    public $country = 'hu';

    public $state = 'Budapest';

    public $zip = '1111';

    public $city = 'Budapest';

    public $address = 'Address 1';

    public $trx = null;

    public static function prepare()
    {
        return new static;
    }

    public function language($language)
    {
        $this->language = $language;

        return $this;
    }

    public function currency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    public function totalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function email($email)
    {
        $this->email = $email;

        return $this;
    }

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    public function company($company)
    {
        $this->company = $company;

        return $this;
    }

    public function country($country)
    {
        $this->country = $country;

        return $this;
    }

    public function state($state)
    {
        $this->state = $state;

        return $this;
    }

    public function zip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    public function city($city)
    {
        $this->city = $city;

        return $this;
    }

    public function address($address)
    {
        $this->address = $address;

        return $this;
    }

    public function createTransaction()
    {
        $config = config('simplepay-laravel');

        $this->trx = new SimplePayStart;

        $this->initDefaults();
        // MAGIC HAPPENS HERE

        $this->trx->addData('currency', $this->currency);

        $this->trx->addConfig($config);

        //ORDER PRICE/TOTAL
        //-----------------------------------------------------------------------------------------
        $this->trx->addData('total', $this->totalPrice);

        //ORDER ITEMS
        //-----------------------------------------------------------------------------------------
        /*
        $this->trx->addItems(
            array(
                'ref' => 'Product ID 1',
                'title' => 'Product name 1',
                'desc' => 'Product description 1',
                'amount' => '1',
                'price' => '5',
                'tax' => '0',
                )
        );

        $this->trx->addItems(
            array(
                'ref' => 'Product ID 2',
                'title' => 'Product name 2',
                'desc' => 'Product description 2',
                'amount' => '1',
                'price' => '2',
                'tax' => '0',
                )
        );
        */

        // OPTIONAL DATA INPUT ON PAYMENT PAGE
        //-----------------------------------------------------------------------------------------
        //$this->trx->addData('maySelectEmail', true);
        //$this->trx->addData('maySelectInvoice', true);
        //$this->trx->addData('maySelectDelivery', ['HU']);

        // SHIPPING COST
        //-----------------------------------------------------------------------------------------
        //$this->trx->addData('shippingCost', 20);

        // DISCOUNT
        //-----------------------------------------------------------------------------------------
        //$this->trx->addData('discount', 10);

        // ORDER REFERENCE NUMBER
        // uniq oreder reference number in the merchant system
        //-----------------------------------------------------------------------------------------
        $this->trx->addData('orderRef', str_replace(['.', ':', '/'], '', @$_SERVER['SERVER_ADDR']).@date('U', time()).rand(1000, 9999));

        // CUSTOMER
        // customer's name
        //-----------------------------------------------------------------------------------------
        //$this->trx->addData('customer', 'v2 SimplePay Teszt');

        // customer's registration mehod
        // 01: guest
        // 02: registered
        // 05: third party
        //-----------------------------------------------------------------------------------------
        $this->trx->addData('threeDSReqAuthMethod', '02');

        // EMAIL
        // customer's email
        //-----------------------------------------------------------------------------------------
        $this->trx->addData('customerEmail', $this->email);

        // LANGUAGE
        // HU, EN, DE, etc.
        //-----------------------------------------------------------------------------------------
        $this->trx->addData('language', $this->language);

        // TWO STEP
        // true, or false
        // If this field does not exist is equal false value
        // Possibility of two step needs IT support setting
        //-----------------------------------------------------------------------------------------
        /*
        if (isset($_REQUEST['twoStep'])) {
            $this->trx->addData('twoStep', true);
        }
        */

        // TIMEOUT
        // 2018-09-15T11:25:37+02:00
        //-----------------------------------------------------------------------------------------
        $timeoutInSec = 600;
        $timeout = @date('c', time() + $timeoutInSec);
        $this->trx->addData('timeout', $timeout);

        // METHODS
        // CARD or WIRE
        //-----------------------------------------------------------------------------------------
        $this->trx->addData('methods', ['CARD']);

        // REDIRECT URLs
        //-----------------------------------------------------------------------------------------

        // common URL for all result
        $this->trx->addData('url', $config['URL']);

        // uniq URL for every result type
        if ($config['SUCCESS_PAGE']) {
            $this->trx->addGroupData('urls', 'success', $config['SUCCESS_PAGE_ROUTE_NAME']);
        }
        if ($config['FAIL_PAGE']) {
            $this->trx->addGroupData('urls', 'fail', $config['FAIL_PAGE_ROUTE_NAME']);
        }
        if ($config['CANCEL_PAGE']) {
            $this->trx->addGroupData('urls', 'cancel', $config['CANCEL_PAGE_ROUTE_NAME']);
        }
        if ($config['TIMEOUT_PAGE']) {
            $this->trx->addGroupData('urls', 'timeout', $config['TIMEOUT_PAGE_ROUTE_NAME']);
        }

        // Redirect from Simple app to merchant app
        //-----------------------------------------------------------------------------------------
        //$this->trx->addGroupData('mobilApp', 'simpleAppBackUrl', 'myAppS01234://payment/123456789');

        // INVOICE DATA
        //-----------------------------------------------------------------------------------------

        $this->trx->addGroupData('invoice', 'name', $this->name);
        if (empty($this->company)) {
            $this->trx->addGroupData('invoice', 'company', $this->company);
        }
        $this->trx->addGroupData('invoice', 'country', $this->country);
        $this->trx->addGroupData('invoice', 'state', $this->state);
        $this->trx->addGroupData('invoice', 'city', $this->city);
        $this->trx->addGroupData('invoice', 'zip', $this->zip);
        $this->trx->addGroupData('invoice', 'address', $this->address);
        //$this->trx->addGroupData('invoice', 'address2', 'Address 2');
        //$this->trx->addGroupData('invoice', 'phone', '06201234567');

        // DELIVERY DATA
        //-----------------------------------------------------------------------------------------
        /*
        $this->trx->addGroupData('delivery', 'name', 'SimplePay V2 Tester');
        $this->trx->addGroupData('delivery', 'company', '');
        $this->trx->addGroupData('delivery', 'country', 'hu');
        $this->trx->addGroupData('delivery', 'state', 'Budapest');
        $this->trx->addGroupData('delivery', 'city', 'Budapest');
        $this->trx->addGroupData('delivery', 'zip', '1111');
        $this->trx->addGroupData('delivery', 'address', 'Address 1');
        $this->trx->addGroupData('delivery', 'address2', '');
        $this->trx->addGroupData('delivery', 'phone', '06203164978');
        */

        //payment starter element
        // auto: (immediate redirect)
        // button: (default setting)
        // link: link to payment page
        //-----------------------------------------------------------------------------------------
        $this->trx->formDetails['element'] = 'link';

        //create transaction in SimplePay system
        //-----------------------------------------------------------------------------------------
        $this->trx->runStart();

        //create html form for payment using by the created transaction
        //-----------------------------------------------------------------------------------------
        $this->trx->getPaymentUrl();

        return $this->trx->returnData;
    }

    public function initDefaults()
    {
        if (! $this->language) {
            $this->language = 'HU';
        }
        if (! $this->currency) {
            $this->currency = 'HUF';
        }
    }
}
