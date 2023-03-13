<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Support\Facades\Http;

class OrderService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_admin.url') . '/orders';
        $this->http = Http::acceptJson()
            ->withHeaders([
                'Authorization' => request()->header('Authorization'),
                'Identify' => request()->header('Identify')
            ]);
    }

    public function getAllOrders($user_id, $bar_id)
    {
        $response = $this->http->get($this->url . '/user/' . $user_id . '/bar/' . $bar_id);

        return $this->defaultResponse->response($response);
    }

    public function getOrderById(string $order_id = null)
    {
        $response = $this->http->get($this->url . '/' . $order_id);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function newOrder(array $params = [])
    {
        $response = $this->http->post($this->url, $params);

        return response()->json(json_decode($response->body()), $response->status());
        // return $this->defaultResponse->response($response);
    }

    public function updateOrderById(string $order_id = null, array $params = [])
    {
        $response = $this->http->put($this->url . '/' . $order_id, $params);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function deleteOrderById(string $order_id = null)
    {
        $response = $this->http->delete($this->url . '/' . $order_id);

        return response()->json(json_decode($response->body()), $response->status());
    }
}
