<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Services\Admin\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class AuthController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function getMe(): JsonResponse
    {
        return $this->authService->getMe();
    }
    public function login(LoginRequest $request): JsonResponse
    {

        return $this->authService->login($request);
    }
    public function logout(Request $request): JsonResponse
    {
        return $this->authService->logout($request);
    }
    public function otpSendMail(Request $request)
    {
        return $this->authService->otpSendMail($request);
    }
    public function forgotPassword(Request $request)
    {

        return $this->authService->forgotPassword($request);
    }
}
