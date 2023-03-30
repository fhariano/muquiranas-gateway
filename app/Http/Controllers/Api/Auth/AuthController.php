<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $authService;
    protected $apikey;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function auth(Request $request)
    {
        $this->apikey = $request->header('apikey');
        Log::channel('auth')->info("Authenticate API-KEY: " . $this->apikey);
        Log::channel('auth')->info("Authenticate E-mail: " . $request->email);
        return $this->authService->sign($request->all(), $this->apikey);
    }
    
    public function me(Request $request)
    {
        $this->apikey = $request->header('apikey');
        Log::channel('auth')->info("ME: " . $this->apikey);
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
