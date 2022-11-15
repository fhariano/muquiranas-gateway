<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        return $this->userService->getAllUsers($request->all());
    }

    public function show($identify)
    {
        return $this->userService->getUserByUUID($identify);
    }

    public function store(Request $request)
    {
        return $this->userService->newUser($request->all());
    }

    public function update(Request $request, $identify)
    {
        Log::channel('muquiranas')->info("User Update: " . print_r($request, true));
        return $this->userService->updateUserByUUID($request->all(), $identify);
    }

    public function updateCellConfirmed(Request $request, $identify)
    {
        return $this->userService->updateCellConfirmed($request->all(), $identify);
    }

    public function destroy($identify)
    {
        return $this->userService->deleteUserByUUID($identify);
    }
}
