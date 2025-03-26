<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repositories\PaymentRepositoryInterface;

class PaymentController extends Controller
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function createPayment(Request $request)
    {
        $request->validate([
            'reservation_ids' => 'required|array',
            'reservation_ids.*' => 'exists:reservations,id'
        ]);

        return $this->paymentRepository->createPayment($request->reservation_ids);
    }

    public function capturePayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string'
        ]);

        return $this->paymentRepository->capturePayment(
            $request->order_id,
            $request->reservation_ids ?? null
        );
    }

    public function cancelPayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string'
        ]);

        return $this->paymentRepository->cancelPayment($request->order_id);
    }
}
