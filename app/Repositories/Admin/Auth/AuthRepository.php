<?php

namespace App\Repositories\Admin\Auth;

use App\Mail\SendMail;
use App\Models\EmailOtp;
use App\Models\RolePermission;
use App\Models\Staff;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthRepository extends BaseRepository
{
    protected $auth;
    public function __construct(Staff $auth)
    {
        $this->auth = $auth;
    }
    public function login($request)
    {
        $staff = Staff::query()->where('email', $request->email)->first();
        if ($staff) {
            if ($staff->status === 1) {
                if (Hash::check($request->password, $staff->password)) {
                    $token = $staff->createToken($staff->email)->plainTextToken;
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

    public function getMe()
    {
        // dd(Auth::user()->fullname);
        return Auth::user();
    }
    public function getRole()
    {
        $user = Auth::user();
        // dd(Auth::user()->fullname);
        $result = RolePermission::query()->where('role_id', '=', $user->role_id)->get();
        return $result;
    }
    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();
        return  $result = [
            'status' => 200,
            'message' => 'Log out Successfully'
        ];
    }

    public function otpSendMail($request)
    {
        $data = Staff::query()->where('email', '=', $request->get('email'))->first();
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

    public function forgotPassword($request)
    {

        $data = Staff::query()->where('email', '=', $request['email'])->first();
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
}
