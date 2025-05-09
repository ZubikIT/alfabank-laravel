<?php

namespace ZubikIT\AlfaBank\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class AlfaBankService
{
    protected $client;
    protected $merchantId;
    protected $login;
    protected $password;
    protected $returnUrl;
    protected $failUrl;
    protected $dynamicCallbackUrl;
    protected $currency;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('alfabank.base_url')]);
        $this->merchantId = config('alfabank.merchant_id');
        $this->login = config('alfabank.login');
        $this->password = config('alfabank.password');
        $this->returnUrl = config('alfabank.return_url');
        $this->failUrl = config('alfabank.fail_url');
        $this->dynamicCallbackUrl = config('alfabank.dynamic_callback_url');
        $this->currency = config('alfabank.currency');
    }

    /**
     * Регистрация ссылки на банк [Создание платежа]
     */
    public function createPayment($orderId, $amount, $email, $expirationDate, $jsonParams)
    {
        $response = $this->client->post('/payment/rest/register.do', [
            'form_params' => [
                'userName' => $this->login,
                'password' => $this->password,
                'orderNumber' => $orderId,
                'amount' => $amount * 100, // Конвертация в копейки
                'currency' => $this->currency,
                'returnUrl' => $this->returnUrl,
                'email' => $email,
                'failUrl' => $this->failUrl,
                'dynamicCallbackUrl' => $this->dynamicCallbackUrl,
                'expirationDate' => $expirationDate,
                'jsonParams' => json_encode($jsonParams, true),
            ],
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        if (isset($result['errorCode'])) {
            Log::error('Ошибка создания платежа: ' . $result['errorMessage']);
            return null;
        }

        return $result;
    }

    //Получение данных с чека

    /**
     * Проверка статуса платежа [основные данные]
     */
    public function getPaymentStatus($orderId)
    {
        $response = $this->client->post('/payment/rest/getOrderStatus.do', [
            'form_params' => [
                'userName' => $this->login,
                'password' => $this->password,
                'orderId' => $orderId,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Проверка статуса платежа [развернутые данные]
     */
    public function getPaymentStatusExtended($orderId)
    {
        $response = $this->client->post('/payment/rest/getOrderStatusExtended.do', [
            'form_params' => [
                'userName' => $this->login,
                'password' => $this->password,
                'orderId' => $orderId,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Отмена платежа
     */
    public function cancelPayment($orderId)
    {
        $response = $this->client->post('/payment/rest/reverse.do', [
            'form_params' => [
                'userName' => $this->login,
                'password' => $this->password,
                'orderId' => $orderId,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
