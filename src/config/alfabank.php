<?php

return [
    'base_url' => env('ALFABANK_URL', 'https://pay.alfabank.ru'),
    'merchant_id' => env('ALFABANK_MERCHANT_ID'),
    'login' => env('ALFABANK_LOGIN'),
    'password' => env('ALFABANK_PASSWORD'),
    'return_url' => env('ALFABANK_RETURN_URL'),
    'fail_url' => env('ALFABANK_FAIL_URL'),
    'dynamic_callback_url' => env('ALFABANKDYNAMICCALLBACKURL')
    'currency' => env('ALFABANK_CURRENCY', 'RUB'),
];