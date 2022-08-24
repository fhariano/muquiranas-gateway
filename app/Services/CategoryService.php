<?php

namespace App\Services;

use App\Http\Utils\DefaultResponse;
use Illuminate\Support\Facades\Http;

class CategoryService
{
    protected $defaultResponse;
    protected $url;
    protected $http;

    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->url = config('microservices.available.micro_admin.url') . '/categories';
        $this->http = Http::acceptJson();
    }

    public function getAllCategories(array $params = [])
    {
        $response = $this->http->get($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function getCategoryById(int $id = null)
    {
        $response = $this->http->get($this->url . '/' . $id);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function getCategoriesByBar(int $bar_id = null)
    {
        $response = $this->http->get($this->url . '/bar/' . $bar_id);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function newCategory(array $params = [])
    {
        $response = $this->http->post($this->url, $params);

        return $this->defaultResponse->response($response);
    }

    public function updateCategoryById(int $id = null)
    {
        $response = $this->http->put($this->url . '/' . $id);

        return response()->json(json_decode($response->body()), $response->status());
    }

    public function deleteCategoryById(int $id = null)
    {
        $response = $this->http->delete($this->url . '/' . $id);

        return response()->json(json_decode($response->body()), $response->status());
    }
}
