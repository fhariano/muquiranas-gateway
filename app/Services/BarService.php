<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Support\Facades\Http;

class BarService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_admin.url') . '/bars';
        $this->http = Http::acceptJson();
    }

    public function getAllBares(array $params = [])
    {
        $response = $this->http->get($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function getBarById(string $id = null)
    {
        $response = $this->http->get($this->url . '/' . $id);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function newBar(array $params = [])
    {
        $response = $this->http->post($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function updateBarById(string $id = null, array $params = [])
    {
        $response = $this->http->put($this->url . '/' . $id, $params);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function deleteBarById(string $id = null)
    {
        $response = $this->http->delete($this->url . '/' . $id);

        return response()->json(json_decode($response->body()), $response->status());
    }
}
