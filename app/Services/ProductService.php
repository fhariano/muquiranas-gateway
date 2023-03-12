<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_admin.url') . '/products';
        $this->http = Http::acceptJson()
            ->withHeaders([
                'Authorization' => request()->header('Authorization')
            ]);
    }

    public function getAllProducts(array $params = [])
    {
        $response = $this->http->get($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function getProductById(int $id = null)
    {
        $response = $this->http->get($this->url . '/' . $id);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function getProductsByBar(int $bar_id = null)
    {
        $response = $this->http->get($this->url . '/bar/' . $bar_id);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function getFavoritesProductsByBar(int $bar_id = null, int $user_id = null)
    {
        $response = $this->http->get($this->url . '/favorites/bar/' . $bar_id . '/user/' . $user_id);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function toggleFavoriteProduct($bar_id, $user_id, array $params = [])
    {
        Log::channel('muquiranas')->info("SERVICE: toggleFavoriteProduct - barId: " . $bar_id . " - UserId: " . $user_id);
        $response = $this->http->put(
            $this->url . '/favorites/bar/' . $bar_id . '/user/' . $user_id,
            $params
        );

        // $response = Http::acceptJson()->put($this->url . '/favorites/bar/' . $bar_id . '/user/' . $user_id, $params);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function newProduct(array $params = [])
    {
        $response = $this->http->post($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function updateProductById(string $id = null)
    {
        $response = $this->http->put($this->url . '/' . $id);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function deleteProductById(int $id = null)
    {
        $response = $this->http->delete($this->url . '/' . $id);

        return response()->json(json_decode($response->body()), $response->status());
    }
}
