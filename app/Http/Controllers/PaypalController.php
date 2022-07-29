<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Payment;
use Exception\Exception;
use Omnipay\PayPal\Message\AbstractRestRequest;

class PaypalController extends Controller
{
    private $gateway;

    public function _construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //this will be set false when going live
    }
    function index()
    {
        return view('payment');
    }
    public function charge(Request $request)
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //this will be set false when going live

        try{
            $response = $this->gateway->purchase(array(
                'amount' => 2000,
                // 'items' => array(
                //     'name' => 'Mechanic Finding Fee',
                //     'price' => 2000,
                //     'description' => 'Payment for finding a Mechanic',
                //     'quantity' => 1,
                // ),
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error'),
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }else {
                return $response->getMessage();
            }

        }catch(Exception $e) {
            return $e->message();
        }
    }

    function success(Request $request)
    {
        //compeleting the transaction after it have been approaved
        if($request->request_id && $request->payerID)
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->request_id,
                'transactionRefrence' => $request->paymentID,
            ));

            $response = $transaction->send();

            if($response->isSuccessful()){
                //User successfully Paid
                $arr_body = $response->getData();
                //inserting the Payment into the database
                $payment = new Payment;
                $payment->request_id = $arr_body['payer_id'];
                $payment->payment_id = $arr_body['id'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->status = $arr_body['state'];
                $payment->save();

                return "Payment was successful";
            }else {
                return $response->getMessage();
            }

        }else {
            return "Transaction declined !!";
        }
    }

    public function error()
    {
        return "User Cancelled the Payment !!!";
    }

}
