<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Exception;

class SMSController extends Controller
{
    function twilioSMS($receiver, $message)
    {
        // Log::alert($message);

        try {

            $account_sid = getenv("TWILIO_SID");
            $account_token = getenv("TWILIO_TOKEN");
            $from = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $account_token);
            $client->messages->create($receiver, [
                'from' => $from,
                'body' => $message]);

            Log:Info('SMS Sent Successfully.');

        } catch (Exception $e) {
            Log::info("Error: ". $e->getMessage());
        }
    }

}
