<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index($user_id, $bar_id)
    {
        return $this->orderService->getAllOrders($user_id, $bar_id);
    }

    public function show($order_id)
    {
        return $this->orderService->getOrderById($order_id);
    }

    public function store(Request $request)
    {
        return $this->orderService->newOrder($request->all());
    }

    public function update(Request $request, $order_id)
    {
        return $this->orderService->updateOrderById($order_id, $request->all());
    }

    public function destroy($order_id)
    {
        return $this->orderService->deleteOrderById($order_id);
    }
}
