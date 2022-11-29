<?php

namespace App\Repositories\Client;

use App\Mail\SendMail;
use App\Models\Customer;
use App\Models\EmailOtp;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthClientRepositories extends BaseRepository
{
    protected $auth;
    public function  __construct(Customer $customer)
    {
        $this->auth = $customer;
    }

    public function register($request)
    {
        $checkMail = Customer::query()->where('email', $request['email'])->first();
        if ($checkMail === null) {
            $result = Customer::query()->create($request);
            $data = [
                'data' => $result,
                'message' => "Register customer successful",
                'status' => 200,
            ];
        } else {
            $data = [
                'message' => "Email available",
                'status' => 403,
            ];
        }

        return $data;
    }

    public function login($request)
    {
        $customer = Customer::query()->where('email', $request->email)->first();
        if ($customer) {
            if ($customer->status === 1) {

                if (Hash::check($request->password, $customer->password)) {

                    $token = $customer->createToken($customer->email)->plainTextToken;

                    $data = [
                        'token' => $token,
                        'message' => "Login successfully",
                        'status' => 200,
                    ];
                } else {
                    $data = [
                        'message' => "Password is incorrect",
                        'status' => 403,
                    ];
                }
            } else {
                $data = [
                    'message' => "Your account has been locked",
                    'status' => 401,
                ];
            }
        } else {
            $data = [
                'message' => "Email does not exits",
                'status' => 403,
            ];
        }
        return $data;
    }

    public function updateCustomerClient($request, $id)
    {
        try {
            $Customer =  Customer::query()->where('id', '=', $id)->first();
            $Customer->update($request->all());
        } catch (\Exception $e) {
            return false;
        }
        return $Customer;
    }

    public function getMeClient()
    {
        return Auth::user();
    }
    public function otpSendMailClient($request)
    {
        $data = Customer::query()->where('email', '=', $request->get('email'))->first();
        // dd($data->id);
        if ($data) {
            $otp = rand(100000, 999999);
            // dd(Mail::to('tanthuan031@gmail.com')->send(new SendMail($otp)));
            if (Mail::to($request->get('email'))->send(new SendMail($otp))) {
                EmailOtp::query()->create([
                    'user_id' => $data->id,
                    'otp' => $otp
                ]);
                return [
                    'status' => 200,
                    'message' => 'Verification code send to your email....'
                ];
            } else {
                return [
                    'status' => 404,
                    'message' => 'Not Found....'
                ];
            }
        } else {
            return [
                'status' => 400,
                'message' => 'Email Not Found',
                'data' => $request->get('email')
            ];
        }
    }

    public function forgotPasswordClient($request)
    {

        $data = Customer::query()->where('email', '=', $request['email'])->first();
        $otp = EmailOtp::query()->where('user_id', '=', $data->id)->where('otp', '=', $request['otp'])->first();
        if ($otp !== null) {
            $data->update([
                'password' => $request['password'],
            ]);
            $otp->delete();
            return [
                'status' => 200,
                'message' => 'Forgot Password Successfully',
            ];
        } else {
            return [
                'status' => 403,
                'message' => 'OTP not found',
            ];
        }
    }
    public function logoutClient($request)
    {
        $request->user()->currentAccessToken()->delete();
        return  $result = [
            'status' => 200,
            'message' => 'Logout Successfully'
        ];
    }
}
