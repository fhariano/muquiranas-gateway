<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        return $this->categoryService->getAllCategories($request->all());
    }

    public function show(Request $request)
    {
        return $this->categoryService->getCategoryById($request->id);
    }

    public function barCategories(Request $request)
    {
        return $this->categoryService->getCategoriesByBar($request->bar_id);
    }

    public function store(Request $request)
    {
        return $this->categoryService->newCategory($request->all());
    }

    public function update(Request $request)
    {
        return $this->categoryService->updateCategoryById($request->id);
    }

    public function destroy(Request $request)
    {
        return $this->categoryService->deleteCategoryById($request->id);
    }
}
