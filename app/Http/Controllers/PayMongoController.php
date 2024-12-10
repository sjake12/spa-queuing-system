<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paymongo\PaymongoClient;

class PayMongoController extends Controller
{
    protected $paymongo;

    public function __construct()
    {
        $this->paymongo = new PaymongoClient(
            config('services.paymongo.secret_key')
        );
    }

    public function createGCashPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string',
            'return_url' => 'required|url'
        ]);

        try {
            // Create GCash payment source
            $source = $this->paymongo->sources->create([
                'type' => 'gcash',
                'amount' => intval($request->amount * 100), // Amount in cents
                'currency' => 'PHP',
                'redirect' => [
                    'success' => $request->return_url,
                    'failed' => $request->return_url
                ]
            ]);

            // Return the payment source details
            return response()->json([
                'source_id' => $source['id'],
                'redirect_url' => $source['attributes']['redirect']['url']
            ]);
        } catch (\Exception $e) {
            \Log::error('PayMongo Source Creation Error: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function handlePaymentWebhook(Request $request)
    {
        // Verify webhook signature
        $payload = $request->getContent();
        $signature = $request->header('Paymongo-Signature');

        // Implement signature verification logic here

        $event = json_decode($payload, true);

        // Handle different event types
        switch ($event['type']) {
            case 'source.chargeable':
                $this->handleChargeableSource($event['data']);
                break;
            case 'payment.paid':
                $this->handleSuccessfulPayment($event['data']);
                break;
        }

        return response()->json(['status' => 'received'], 200);
    }

    public function handlePaymentReturn()
    {
        dd('Payment successful');
    }

    protected function handleChargeableSource($sourceData)
    {
        // Create payment from the chargeable source
        $payment = $this->paymongo->payment()->create([
            'amount' => $sourceData['attributes']['amount'],
            'currency' => $sourceData['attributes']['currency'],
            'source' => [
                'id' => $sourceData['id'],
                'type' => 'source'
            ]
        ]);

        // Update your order or transaction status
    }

    protected function handleSuccessfulPayment($paymentData)
    {
        // Update order status, mark as paid, etc.
    }
}
