<?php

namespace App\Repositories;

use App\Models\Reservation;
use Carbon\Carbon;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentRepository implements PaymentRepositoryInterface
{
    protected $paypalClient;

    public function __construct()
    {
        $this->paypalClient = new PayPalClient;
        $this->paypalClient->setApiCredentials(config('paypal'));
        $this->paypalClient->getAccessToken();
    }

    public function createPayment($reservationIds)
    {
        // Handle single ID or array of IDs
        if (!is_array($reservationIds)) {
            $reservationIds = [$reservationIds];
        }

        $reservations = Reservation::whereIn('id', $reservationIds)
            ->where('status', 'pending')
            ->get();


        if ($reservations->isEmpty()) {
            return response()->json(['error' => 'No valid pending reservations found'], 404);
        }

        // Check if any reservations have expired
        foreach ($reservations as $reservation) {
            if (Carbon::now()->gt($reservation->expires_at)) {
                $reservation->status = 'expired';
                $reservation->save();
                return response()->json(['error' => 'One or more reservations have expired'], 400);
            }
        }


































        // Calculate total amount
        $totalAmount = $reservations->sum('price');

        // Create PayPal order
        $response = $this->paypalClient->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('api.payments.success'),
                "cancel_url" => route('api.payments.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($totalAmount, 2, '.', '')
                    ],
                    "description" => "Reservation(s) #" . implode(', #', $reservationIds),
                    "reference_id" => implode('-', $reservationIds)
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // Store the order ID with each reservation
            foreach ($reservations as $reservation) {
                $reservation->payment_id = $response['id'];
                $reservation->save();
            }

            return response()->json([
                'id' => $response['id'],
                'links' => $response['links']
            ]);
        }

        return response()->json(['error' => 'Failed to create PayPal order'], 500);
    }

    public function capturePayment($orderId, $reservationIds = null)
    {
        // If reservation IDs aren't provided, find them by payment ID
        if (!$reservationIds) {
            $reservations = Reservation::where('payment_id', $orderId)->get();
            $reservationIds = $reservations->pluck('id')->toArray();
        } else if (!is_array($reservationIds)) {
            $reservationIds = [$reservationIds];
        }

        if (empty($reservationIds)) {
            return response()->json(['error' => 'No reservations found for this payment'], 404);
        }

        $response = $this->paypalClient->capturePaymentOrder($orderId);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // Update all reservations associated with this payment
            Reservation::whereIn('id', $reservationIds)
                ->update([
                    'status' => 'confirmed',
                    'payment_status' => $response['status']
                ]);

            return response()->json([
                'message' => 'Payment completed successfully',
                'reservation_ids' => $reservationIds
            ]);
        }

        // Mark reservations as payment failed
        Reservation::whereIn('id', $reservationIds)
            ->update([
                'status' => 'payment_failed',
                'payment_status' => $response['status'] ?? 'FAILED'
            ]);

        return response()->json(['error' => 'Payment failed', 'details' => $response], 400);
    }

    public function cancelPayment($orderId)
    {
        $reservations = Reservation::where('payment_id', $orderId)->get();

        if ($reservations->isEmpty()) {
            return response()->json(['error' => 'No reservations found for this payment'], 404);
        }

        // Mark all reservations as payment cancelled
        foreach ($reservations as $reservation) {
            $reservation->payment_status = 'cancelled';
            $reservation->save();
        }

        return response()->json([
            'message' => 'Payment cancelled',
            'reservation_ids' => $reservations->pluck('id')->toArray()
        ]);
    }
}
