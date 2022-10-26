<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Support\Facades\Http;

class RegisterService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_auth.url');
        $this->http = Http::acceptJson()->timeout(120);
    }

    public function register(array $params = [], $apikey = null)
    {
        $params['apikey'] = $apikey;
        $response = $this->http->post($this->url. '/register', $params);

        return $this->defaultResponse->response($response);
    }

    public function resendCode(array $params = [], $apikey = null)
    {
        $params['apikey'] = $apikey;
        $response = $this->http->post($this->url. '/resendCode', $params);

        return $this->defaultResponse->response($response);
    }
}
