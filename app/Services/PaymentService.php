<?php

namespace App\Services;

class PaymentService
{

    public $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function process()
    {
        return $this->paymentGateway->execute();
    }
}