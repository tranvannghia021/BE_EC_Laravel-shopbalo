<?php

namespace App\Services\Admin\Auth;

use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\Auth\AuthRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use ApiResponse;
    protected AuthRepository $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function login($data)
    {
        $result = $this->authRepository->login($data);
        if ($result['status'] == 200) {
            return response()->json([
                "data" => $result,
            ], 200);
        } else {
            return response()->json([
                "data" => $result
            ], $result['status']);
        }
    }
    public function getMe()
    {
        $result = $this->authRepository->getMe();
        $role = $this->authRepository->getRole();
        $arrayData = [
            'id' =>  $result->id,
            'first_name' =>  $result->first_name,
            'last_name' =>  $result->last_name,
            'gender' =>  $result->gender,
            'phone' =>  $result->phone,
            'email' =>  $result->email,
            'role_id' =>  $result->role_id,
            'role_permissions' => $role,
            'password' =>  $result->password,
            'point' =>  $result->point,
            'avatar' => (explode("://", $result->avatar))[0] === "https" ?  $result->avatar : env('APP_URL') . '/storage/staff/'  .  $result->avatar,
            'status' =>  $result->status,
            'address' =>  $result->address,
            'created_date' =>  $result->created_date,
            'created_at' =>  $result->created_at,
            'updated_at' =>  $result->updated_at,


        ];
        return $this->apiResponse($arrayData, 'success', 'Get Information Successfully');
        // return $this->apiResponse($result, 'success', 'Get Information Successfully');
    }

    public function logout($request)
    {

        $result = $this->authRepository->logout($request);
        if ($result['status'] === 200) {
            return $this->apiResponse([], 'success', $result['message'], $result['status']);
        }
    }
    public function otpSendMail($request)
    {
        $result = $this->authRepository->otpSendMail($request);
        if ($result['status'] == 200) {
            return $this->apiResponse([], $result['status'], $result['message']);
        } else {
            return $this->apiResponse([], $result['status'],  $result['message']);
        }
    }
    public function forgotPassword($request)
    {

        if (!empty($request->get('email')) && !empty($request->get('otp')) && !empty($request->get('password'))) {
            $dataRequest = [
                'email' => $request->get('email'),
                'password' => Hash::make($request->password),
                'otp' => $request->get('otp')
            ];
            $result = $this->authRepository->forgotPassword($dataRequest);
        } else {
            $result = [
                'status' => 403,
                'message' => 'Field not found',
            ];
        }

        // dd($result);
        if ($result['status'] === 200) {
            return $this->apiResponse([], 'success', $result['message']);
        } else {
            return $this->apiResponse([], $result['status'], $result['message']);
        }
    }
}
