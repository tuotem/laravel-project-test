<?php

namespace App\Services;

class PaymentGateway
{

    public $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function execute()
    {
        return "Execute";
    }
}