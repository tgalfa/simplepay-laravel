<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use zoparga\SimplePayLaravel\SDK\SimplePayBack;
use zoparga\SimplePayLaravel\SimplePayLaravel;

class StartPayByUrl
{
    public function inRoutesFile()
    {
        // IN ROUTES FILE
        // ADD AN ENDPOINT WHICH WILL HANDLE DATA SUBMIT
        Route::post('simplepay-form', [SimplePayController::class, 'simplePayFormSubmit'])->name('simplepay-form.submit');

        Route::get('simplepay-success', [SimplePayController::class, 'simplePaySuccess'])->name('simplepay-success-page');
    }

    // CONTROLLER METHOD

    public function simplePayFormSubmit(Request $request)
    {
        // PREPARE DATAS
        $language = $request->get('language', 'hu');
        $currency = $request->get('currency', 'HUF');
        $price = $request->get('price');

        $email = $request->get('email');
        $name = $request->get('name');
        $company = $request->get('company'); // COMPANY IS OPTIONAL, YOU CAN LEAVE IT BLANK
        $country = $request->get('country');
        $state = $request->get('state');
        $zip = $request->get('zip');
        $city = $request->get('city');
        $address = $request->get('address');

        // SIMPLY CALL THIS HELPER
        $url = SimplePayLaravel::prepare()
            ->language($language)
            ->currency($currency)
            ->totalPrice($price)
            ->email($email)
            ->name($name)
            ->company($company)
            ->country($country)
            ->state($state)
            ->zip($zip)
            ->city($city)
            ->address($address)
            ->send();

        // IT WILL RETURN THE PAYMENT URL, THIS WILL HANDY IN CASE OF API
        return $url;

        // OR YOU CAN REDIRECT YOUR USER TO THE DESIRED URL
        return redirect()->away($url);
    }

    public function simplePayResponse()
    {
        $config = config('simplepay-laravel');
        $trx = new SimplePayBack;
        $trx->addConfig($config);

        //result
        $results = [];
        if (isset($_REQUEST['r']) && isset($_REQUEST['s'])) {
            if ($trx->isBackSignatureCheck($_REQUEST['r'], $_REQUEST['s'])) {
                $results = $trx->getRawNotification();
            }
        }

        return view('simplepay.success', compact('results'));
    }
}
