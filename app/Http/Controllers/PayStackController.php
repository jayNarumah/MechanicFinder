<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayStackController extends Controller
{
    public function index()
    {

    }

    public function makePayment(Request $request)
    {
        $formData = [
            'email' => $request->email,
            'amount' =>  $request->amount * 100,
            'callback_url' => route('pay.callback'),
        ];

        $pay = json_decode($this->initiatePayment($formData));

        if ($pay) {
            if ($pay->status) {
                return redirect($pay->data->authorization_url);
            }
            else {
                return back()->withError($pay->message);
            }
        }else {
            return back()->withError("Some thing went wrong!!!");
        }
        dd($pay);

    }
    public function initiatePayment($formData)
    {
        $url = "https://api.paystack.co/transaction/initialize";
        $fields_string = http_build_query($formData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".env("PAYSTACK_SECRET_KEY"),
            "Cache-Control: no-cache"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;

    }

    public function verifyPay($reference)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".env("PAYSTACK_SECRET_KEY"),
                "Cache-Control: no-cache",
        ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);
        // $new_data = json_decode($response);

        return $response;


    }
    public function payCallback()
    {
        $response = json_decode($this->verifyPay(request('reference')));

        if ($response) {
            if ($response->status) {
                $data = $response->data;
                return view('pay.callback')->with(compact([$data]));
            }
            else {
                return back()->withError($response->message);
            }
        }else {
            return back()->withError("Some thing went wrong!!!");
        }

        dd($response);
        return view('pay.callback_page');
    }

    public function verify($refrence)
    {
        $secret = "sk_test_78d26f13608fc911c6de4f1cbc7937c7b6a31b12";
        $curl = curl_init();

        curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.paystack.co/transaction/verify/$refrence",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $secret",
        "Cache-Control: no-cache",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $new_data = json_decode($response);

        return [$new_data];

    }
}
