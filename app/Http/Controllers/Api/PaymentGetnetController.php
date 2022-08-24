<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentGetnetService;
use Illuminate\Http\Request;

class PaymentGetnetController extends Controller
{
    protected $getnetService;

    public function __construct(PaymentGetnetService $getnetService)
    {
        $this->getnetService = $getnetService;
    }

    public function getBrands()
    {
        return $this->getnetService->getBrands();
    }

    public function processPayment(Request $request)
    {
        return $this->getnetService->processPayment($request->all());
    }
}
