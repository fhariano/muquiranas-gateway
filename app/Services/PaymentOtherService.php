<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymentOtherService
{
    protected $url;
    protected $http;

    public function __construct()
    {
        $this->url = config('microservices.available.micro_payment.url') . '/list-others';
        $this->http = Http::acceptJson();
    }

    public function getAllOthers(array $params = [])
    {
        $response = $this->http->get($this->url, $params);

        return response()->json(json_decode($response), $response->status());
    }
}
