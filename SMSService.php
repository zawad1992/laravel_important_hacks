<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;

/**
 * SMSService Class
 *
 * This service class includes the sendSMS function for sending SMS messages using an external SMS gateway.
 * The function uses the Guzzle HTTP client to make an API request to the SMS gateway.
 *
 * Usage:
 * - Inject this service into controllers where SMS sending functionality is required.
 * - Call the sendSMS method with the necessary parameters to send an SMS.
 * - Replace the placeholders in the $params array with actual values from your SMS gateway provider.
 *
 * Note:
 * - Ensure you have installed the GuzzleHttp package via Composer.
 * - The function logs the sent message details in the 'mobile_messages' table. Ensure this table exists in your database.
 */

class SMSService
{
    /**
     * Send an SMS message to a specified mobile number.
     *
     * @param string $mobile_no Mobile number to send the SMS to.
     * @param string $message The message content.
     * @param string $request_from Optional parameter to identify the SMS request context.
     * @return bool Returns true on success, false on failure.
     */
    public function sendSMS($mobile_no, $message, $request_from = "")
    {
        $client = new Client();
        // Replace the following parameters with actual data from your SMS gateway
        $params = [
            'username' => '{SMSGatewayUsername}',
            'password' => '{SMSGatewayPassword}',
            'apicode' => 1,
            'msisdn' => $mobile_no,
            'countrycode' => '{CountryCode}',
            'cli' => '{CLI if available}',
            'messagetype' => '1',
            'message' => $message,
            'messageid' => '0'
        ];

        try {
            $response = $client->post('https://yoursmsgatewayurl.com', [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                'body' => json_encode($params),
                'verify' => false
            ]);

            $result = json_decode($response->getBody(), true);

            if (!empty($result) && $result['statusCode'] == "200") {
                if ($request_from === "first_otp" || $request_from === "resend_otp") {
                    $message = preg_replace("/\d/", "X", $message);
                }

                DB::table('mobile_messages')->insert([
                    'mobile_no' => $mobile_no,
                    'message_content' => $message,
                    'message_from' => $request_from,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'ip' => request()->ip()
                ]);

                return true;
            }
        } catch (GuzzleException $e) {
            // Handle the exception or log it
        }

        return false;
    }
}

/*****************
Instructions for Use:

    - Save this content in a file named SMSService.php in the app/Services directory of your Laravel application. Create the directory if it doesn't exist.
    - Replace placeholders like {SMSGatewayUsername}, {SMSGatewayPassword}, {CountryCode}, and https://yoursmsgatewayurl.com with actual values from your SMS gateway provider.
    - Inject this service into any controller where you need to send SMS. For example:

    ```PHP
    use App\Services\SMSService;

    class SomeController extends Controller
    {
        protected $smsService;

        public function __construct(SMSService $smsService)
        {
            $this->smsService = $smsService;
        }

        public function someMethod()
        {
            $mobile_no = '1234567890';
            $message = 'Your SMS message';
            $request_from = 'context';

            $this->smsService->sendSMS($mobile_no, $message, $request_from);
            // Handle the response accordingly
        }
    }
    ```
***************/