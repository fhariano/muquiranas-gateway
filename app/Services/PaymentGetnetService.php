<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentGetnetService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_payment.url');
        $this->http = Http::acceptJson();
    }

    public function getCallback(array $params = [])
    {   
        return response()->json(["message" => "GETNET CALLBACK - Success"], 200);
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

    public function getOthers()
    {
        $response = $this->http->get($this->url . '/getnet-others');

        return response()->json(json_decode($response), $response->status());
    }

    public function processPix(array $params = [])
    {
        $response = $this->http->post($this->url . '/getnet-process-pix', $params);

        return response()->json(json_decode($response), $response->status());
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

        Log::channel('muquiranas')->info("removeCardById response: " . print_r(json_decode($response), true));

        return response()->json(json_decode($response), $response->status());
    }
}
