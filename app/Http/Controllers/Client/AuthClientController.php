<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Services\Client\AuthClientServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthClientController extends Controller
{
    protected AuthClientServices $authService;
    public function __construct(AuthClientServices $authService)
    {
        $this->authService = $authService;
    }
    public function register(Request $request)
    {
        return $this->authService->register($request);
    }

    public function login(Request $request)
    {
        return $this->authService->login($request);
    }
    public function updateprofile(Request $request, $id)
    {
        return $this->authService->updateCustomerClient($request, $id);
    }
    public function otpSendMailClient(Request $request)
    {
        return $this->authService->otpSendMailClient($request);
    }
    public function forgotPasswordClient(Request $request)
    {

        return $this->authService->forgotPasswordClient($request);
    }
    public function getMeClient(): JsonResponse
    {
        return $this->authService->getMeClient();
    }
    public function logoutClient(Request $request): JsonResponse
    {
        return $this->authService->logoutClient($request);
    }
}
