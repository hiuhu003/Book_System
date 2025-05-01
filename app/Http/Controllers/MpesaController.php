<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    private $consumerKey;
    private $consumerSecret;
    private $passKey;
    private $businessShortCode;
    private $callbackUrl;

    public function __construct()
    {
        $this->consumerKey = env('MPESA_CONSUMER_KEY');
        $this->consumerSecret = env('MPESA_CONSUMER_SECRET');
        $this->passKey = env('MPESA_PASS_KEY');
        $this->businessShortCode = env('MPESA_BUSINESS_SHORT_CODE');
        $this->callbackUrl = env('MPESA_CALLBACK_URL');
    }

    // Helper function to get the timestamp in YYYYMMDDHHmmss format
    private function getTimestamp()
    {
        return now()->format('YmdHis');
    }

    // Helper function to generate the password for STK Push
    private function getPassword($timestamp)
    {
        $password = $this->businessShortCode . $this->passKey . $timestamp;
        return base64_encode($password);
    }

    // Function to get OAuth access token from Safaricom
    private function getAccessToken()
    {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $credentials = base64_encode($this->consumerKey . ':' . $this->consumerSecret);

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials,
        ])->get($url);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception('Failed to get access token: ' . $response->body());
    }

    // Route to initiate STK Push
    public function initiateSTKPush(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'phoneNumber' => 'required|regex:/^254\d{9}$/',
                'amount' => 'required|numeric|min:1',
            ]);

            $phoneNumber = $request->phoneNumber;
            $amount = $request->amount;

            // Get access token
            $accessToken = $this->getAccessToken();
            $timestamp = $this->getTimestamp();
            $password = $this->getPassword($timestamp);

            // STK Push request payload
            $payload = [
                'BusinessShortCode' => $this->businessShortCode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phoneNumber,
                'PartyB' => $this->businessShortCode,
                'PhoneNumber' => $phoneNumber,
                'CallBackURL' => $this->callbackUrl,
                'AccountReference' => 'Donation',
                'TransactionDesc' => 'Coffee Donation',
            ];

            // Send STK Push request to Safaricom
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', $payload);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json(),
                ]);
            }

            return response()->json([
                'success' => false,
                'error' => 'Failed to initiate STK Push: ' . $response->body(),
            ], 500);

        } catch (\Exception $e) {
            Log::error('STK Push Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Callback route to handle STK Push response from Safaricom
    public function callback(Request $request)
    {
        $callbackData = $request->input('Body.stkCallback');
        Log::info('STK Callback Response: ' . json_encode($callbackData));

        if ($callbackData['ResultCode'] === 0) {
            $transactionDetails = $callbackData['CallbackMetadata']['Item'];
            Log::info('Payment Successful: ' . json_encode($transactionDetails));
        } else {
            Log::error('Payment Failed: ' . $callbackData['ResultDesc']);
        }

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Accepted',
        ]);
    }
}
