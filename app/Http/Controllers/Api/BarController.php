<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BarService;
use Illuminate\Http\Request;

class BarController extends Controller
{
    protected $barService;

    public function __construct(BarService $barService)
    {
        $this->barService = $barService;
    }

    public function index(Request $request)
    {
        return $this->barService->getAllBares($request->all());
    }

    public function show($id)
    {
        return $this->barService->getBarById($id);
    }

    public function store(Request $request)
    {
        return $this->barService->newBar($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->barService->updateBarById($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->barService->deleteBarById($id);
    }
}
