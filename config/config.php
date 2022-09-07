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

    // BELOW USE NAMED ROUTES AS PARAMETERS FOR ROUTE NAME
    'URL' => env('SP_URL_RETURN', 'simplepay.success-page'),

    'SUCCESS_PAGE' => env('SP_SUCCESS_PAGE', false),
    'SUCCESS_PAGE_ROUTE_NAME' => env('SP_SUCCESS_PAGE_ROUTE_NAME', 'simplepay.success-page'),

    'FAIL_PAGE' => env('SP_FAIL_PAGE', false),
    'FAIL_PAGE_ROUTE_NAME' => env('SP_FAIL_PAGE_ROUTE_NAME', 'simplepay.fail-page'),

    'CANCEL_PAGE' => env('SP_CANCEL_PAGE', false),
    'CANCEL_PAGE_ROUTE_NAME' => env('SP_CANCEL_PAGE_ROUTE_NAME', 'simplepay.cancel-page'),

    'TIMEOUT_PAGE' => env('SP_TIMEOUT_PAGE', false),
    'TIMEOUT_PAGE_ROUTE_NAME' => env('SP_TIMEOUT_PAGE_ROUTE_NAME', 'simplepay.timeout-page'),
    // ABOVE USE NAMED ROUTES

    'GET_DATA' => (isset($_GET['r']) && isset($_GET['s'])) ? ['r' => $_GET['r'], 's' => $_GET['s']] : [],
    'POST_DATA' => $_POST,
    'SERVER_DATA' => $_SERVER,

    'LOGGER' => true,                              //basic transaction log
    'LOG_PATH' => 'log',                           //path of log file

    //3DS
    'AUTOCHALLENGE' => true,                      //in case of unsuccessful payment with registered card run automatic challange

];
