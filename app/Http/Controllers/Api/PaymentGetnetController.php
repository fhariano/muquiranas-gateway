<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentGetnetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentGetnetController extends Controller
{
    protected $getnetService;

    public function __construct(PaymentGetnetService $getnetService)
    {
        $this->getnetService = $getnetService;
    }

    public function processPix(Request $request)
    {
        return $this->getnetService->processPix($request->all());
    }

    public function processPayment(Request $request)
    {
        return $this->getnetService->processPayment($request->all());
    }
    
    public function saveCard(Request $request)
    {
        return $this->getnetService->saveCard($request->all());
    }

    public function getCardById(Request $request)
    {
        return $this->getnetService->getCardById($request->card_id);
    }
    
    public function getCardByCustomerId(Request $request)
    {
        Log::channel('muquiranas')->info("getCardByCustomerId: " . print_r($request->all(), true));
        return $this->getnetService->getCardByCustomerId($request->customer_id);
    }

    public function removeCardById(Request $request)
    {
        Log::channel('muquiranas')->info("removeCardById: " . print_r($request->all(), true));
        return $this->getnetService->removeCardById($request->card_id);
    }


    public function getBrands()
    {
        return $this->getnetService->getBrands();
    }

    public function getOthers()
    {
        return $this->getnetService->getOthers();
    }

    public function getCallback(Request $request)
    {
        Log::channel('muquiranas')->info("callback return: " . print_r($request->all(), true));
        return $this->getnetService->getCallback();
    }
}
