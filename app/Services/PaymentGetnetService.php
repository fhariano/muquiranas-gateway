<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Support\Facades\Http;

class PaymentGetnetService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_payment_getnet.url');
        $this->http = Http::acceptJson();
    }

    public function getBrands()
    {
        $response = $this->http
            ->withHeaders([
                'Authorization' => request()->header('Authorization')
            ])
            ->get($this->url . '/getnet-list-brands');

        return response()->json(json_decode($response), $response->status());
    }

    public function getCallback(array $params = [])
    {   
        return response()->json(["message" => "GETNET CALLBACK - Success"], 200);
    }

    public function processPayment(array $params = [])
    {
        $response = $this->http->post($this->url . '/getnet-process-payment', $params);

        return response()->json(json_decode($response), $response->status());
    }

    public function saveCard(array $params = [])
    {
        $response = $this->http->post($this->url . '/getnet-card', $params);

        return response()->json(json_decode($response), $response->status());
    }

    public function getCardById(string $card_id = "")
    {
        $response = $this->http->get($this->url . '/getnet-card/' . $card_id);

        return response()->json(json_decode($response), $response->status());
    }

    public function getCardByCustomerId(string $customer_id = "")
    {
        $response = $this->http->get($this->url . '/getnet-card/customer/' . $customer_id);

        return response()->json(json_decode($response), $response->status());
    }

    public function removeCardById(string $card_id = "")
    {
        $response = $this->http->delete($this->url . '/getnet-card/' . $card_id);

        return response()->json(json_decode($response), $response->status());
    }
}
