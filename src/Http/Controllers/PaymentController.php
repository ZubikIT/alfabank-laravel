<?php

namespace ZubikIT\AlfaBank\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ZubikIT\AlfaBank\Facades\AlfaBank;

class PaymentController extends Controller
{
    /**
     * Создание платежа и редирект
     */
    public function createPayment(Request $request) {
        $orderId = uniqid();
        $amount = $request->input('amount');
        $payment = AlfaBank::createPayment($orderId, $amount);

        if($payment && isset($payment['formUrl']))
        {
            return redirect($payment['formUrl']);
        }

        return back()->withErrors(['msg' => 'Не удалось создать платеж']);
    }

    /**
     * Обработка возврата пользователя после оплаты
     */
    public function paymentCallback(Request $request) {
        $orderId = $request->input('orderId');
        $status = AlfaBank::getPaymentStatus($orderId);

        if($status['orderStatus'] == 2) {
            return view('payment.success');
        }

        return view('payment.failure');
    }
}
