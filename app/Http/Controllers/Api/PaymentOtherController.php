<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentOtherService;
use Illuminate\Http\Request;

class PaymentOtherController extends Controller
{
    protected $paymentOtherService;

    public function __construct(PaymentOtherService $paymentOtherService)
    {
        $this->paymentOtherService = $paymentOtherService;
    }

    public function index(Request $request)
    {
        return $this->paymentOtherService->getAllOthers($request->all());
    }
}
