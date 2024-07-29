# alfabank-laravel
Alfabank payment integration for Laravel

### Config.php
```
'base_url' => env('ALFABANK_URL', 'https://pay.alfabank.ru'),
'merchant_id' => env('ALFABANK_MERCHANT_ID'),
'login' => env('ALFABANK_LOGIN'),
'password' => env('ALFABANK_PASSWORD'),
'return_url' => env('ALFABANK_RETURN_URL'),
'currency' => env('ALFABANK_CURRENCY', 'RUB'),
```
### Functions
1. createPayment($orderId, $amount) - create alfabank link for user
2. getPaymentStatus($orderId) - get short payment status 
3. getPaymentStatusExtended($orderId) - get extended payment status
4. cancelPayment($orderId) - cancel payment
