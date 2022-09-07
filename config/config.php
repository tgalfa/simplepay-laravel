<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    //HUF
    'HUF_MERCHANT' => env('SP_HUF_MERCHANT'),            //merchant account ID (HUF)
    'HUF_SECRET_KEY' => env('SP_HUF_SECRET_KEY'),          //secret key for account ID (HUF)

    //EUR
    'EUR_MERCHANT' => env('SP_EUR_MERCHANT'),            //merchant account ID (EUR)
    'EUR_SECRET_KEY' => env('SP_EUR_SECRET_KEY'),          //secret key for account ID (EUR)

    //USD
    'USD_MERCHANT' => env('SP_USD_MERCHANT'),            //merchant account ID (USD)
    'USD_SECRET_KEY' => env('SP_USD_SECRET_KEY'),          //secret key for account ID (USD)

    'SANDBOX' => env('SP_SANDBOX', true),

    //common return URL
    //'URL' => env('SP_URL_RETURN', 'http://'.$_SERVER['HTTP_HOST'].'/back.php'),
    'URL' => env('SP_URL_RETURN'),

    //optional uniq URL for events
    /*
 'URLS_SUCCESS' => 'http://' . $_SERVER['HTTP_HOST'] . '/success.php',       //url for successful payment
 'URLS_FAIL' => 'http://' . $_SERVER['HTTP_HOST'] . '/fail.php',             //url for unsuccessful
 'URLS_CANCEL' => 'http://' . $_SERVER['HTTP_HOST'] . '/cancel.php',         //url for cancell on payment page
 'URLS_TIMEOUT' => 'http://' . $_SERVER['HTTP_HOST'] . '/timeout.php',       //url for payment page timeout
 */

    'GET_DATA' => (isset($_GET['r']) && isset($_GET['s'])) ? ['r' => $_GET['r'], 's' => $_GET['s']] : [],
    'POST_DATA' => $_POST,
    'SERVER_DATA' => $_SERVER,

    'LOGGER' => true,                              //basic transaction log
    'LOG_PATH' => 'log',                           //path of log file

    //3DS
    'AUTOCHALLENGE' => true,                      //in case of unsuccessful payment with registered card run automatic challange

];
