<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getPermissionsUser($identify)
    {
        return $this->userService->getPermissionsUser($identify);
    }

    public function addPermissionUser(Request $request)
    {
        return $this->userService->addNewPermissionsForUser($request->all());
    }

    public function removePermissionUser(Request $request)
    {
        return $this->userService->removePermissionsForUser($request->all());
    }
}
