<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function auth(Request $request)
    {
        return $this->authService->sign($request->all());
    }

    public function me(Request $request)
    {
        return $this->authService->getMe([
            'Authorization' => $request->header('Authorization')
        ]);
    }

    public function logout(Request $request)
    {
        return $this->authService->sigout([
            'Authorization' => $request->header('Authorization')
        ]);
    }
}
