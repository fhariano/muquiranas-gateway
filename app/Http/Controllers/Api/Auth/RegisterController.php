<?php 
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    protected $registerService;
    protected $apikey;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(Request $request){
        $this->apikey = $request->header('apikey');
        Log::channel('auth')->info("API-KEY: " . $this->apikey);
        Log::channel('auth')->info("request: " . print_r($request->all(), true));
        return $this->registerService->register($request->all(), $this->apikey);
    }
}