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

    public function processPayment(array $params = [])
    {
        $response = $this->http->post($this->url . '/getnet-process-payment', $params);

        return response()->json(json_decode($response), $response->status());
    }
}
