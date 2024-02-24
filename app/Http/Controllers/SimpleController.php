<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Services\SimpleService;
use Illuminate\Http\Request;

class SimpleController extends Controller
{
    public function index(PaymentService $paymentService)
    {
        dd(app());
    }
}
