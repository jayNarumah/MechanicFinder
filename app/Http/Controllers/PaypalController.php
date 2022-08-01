<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Omnipay\Omnipay;
use App\Models\Payment;
use Exception\Exception;

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

        $setting = Setting::where('attribute', 'system_charge')->first();
        $amount = $setting->value;

        try{
            $response = $this->gateway->purchase(array(
                'amount' => $amount,
                'items' => array(
                    array(
                        'name' => 'Mechanic Finding Fee',
                        'price' => $amount,
                        'description' => 'Payment for finding a Mechanic',
                        'quantity' => 1
                    )
                ),
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
        if($request->input('payementId') && $request->input('payerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionRefrence' => $request->input('paymentId'),
            ));

            $response = $transaction->send();

            if($response->isSuccessful()){
                //User successfully Paid
                $arr_body = $response->getData();
                //inserting the Payment into the database
                $payment = new Payment;
                $payment->payer_id = $arr_body['payer_id'];
                $payment->payment_id = $arr_body['id'];
                $payment->payment_id = $arr_body['payer']['payer_info']['email'];
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
