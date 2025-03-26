<?php

namespace App\Repositories;

interface PaymentRepositoryInterface
{
    public function createPayment($reservationIds);
    public function capturePayment($orderId, $reservationIds = null);
    public function cancelPayment($orderId);
}
