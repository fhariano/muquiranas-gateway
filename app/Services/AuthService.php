<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_auth.url');
        $this->http = Http::acceptJson();
    }

    public function sign(array $params = [], $apikey = null)
    {
        $params['apikey'] = $apikey;
        $response = $this->http->post($this->url . '/auth', $params);

        Log::channel('auth')->info('response: ' . print_r($response, true));

        return response()->json(json_decode($response), $response->status());
    }

    public function getMe(array $headers)
    {
        // Log::channel('auth')->info('ME headers: ' . print_r($this->http->withHeaders($headers), true));
        $response = $this->http
        ->withHeaders($headers)
        ->get($this->url . '/me');
        
        Log::channel('auth')->info('ME response: ' . print_r($response, true));
        return response()->json(json_decode($response), $response->status());
    }

    public function sigout(array $headers)
    {
        $response = $this->http
            ->withHeaders($headers)
            ->post($this->url . '/logout');

        return response()->json(json_decode($response), $response->status());
    }
}
