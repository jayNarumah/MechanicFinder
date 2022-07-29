<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Exception;

class SMSController extends Controller
{
    function twilio()
    {
        $receiver_number = "+2347066352444";
        $message = "Dear ";
        // Log::alert($message);

        try {

            $account_sid = getenv("TWILIO_SID");
            $account_token = getenv("TWILIO_TOKEN");
            $from = getenv("TWILIO_FROM");
           // Log::info($account_sid);

            $client = new Client($account_sid, $account_token);
            $client->messages->create($receiver_number, [
                'from' => $from,
                'body' => $message]);

            Log:Info('SMS Sent Successfully.');

        } catch (Exception $e) {
            Log::info("Error: ". $e->getMessage());
        }

    }

}
