<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        return $this->productService->getAllProducts($request->all());
    }

    public function show(Request $request)
    {
        return $this->productService->getProductById($request->id);
    }

    public function barProducts(Request $request)
    {
        return $this->productService->getProductsByBar($request->bar_id);
    }

    public function favoritesProducts(Request $request)
    {
        return $this->productService->getFavoritesProductsByBar($request->bar_id, $request->user_id);
    }

    public function toggleFavoriteProduct(Request $request)
    {
        return $this->productService->toggleFavoriteProduct($request->bar_id, $request->user_id, $request->all());
    }

    public function store(Request $request)
    {
        return $this->productService->newProduct($request->all());
    }

    public function update(Request $request)
    {
        return $this->productService->updateProductById($request->id);
    }

    public function destroy(Request $request)
    {
        return $this->productService->deleteProductById($request->id);
    }
}
