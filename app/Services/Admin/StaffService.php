<?php

namespace App\Services\Admin;

use App\Helpers\Helper;
use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\StaffRepository;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Admin\StatictisRepository;

class StaffService
{
    use apiResponse;
    protected StaffRepository $staffRepository;

    public function __construct(StaffRepository $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }

    public function getAllStaff($request)
    {

        $result = $this->staffRepository->getAllStaff($request);

        if ($result) {
            return $this->apiResponse($result, 'success', 'Get all staff success');
        } else {
            return $this->apiResponse([], 'fail', 'Get staff unsuccessful');
        }
    }

    public function  showStaff($id)
    {
        $result = $this->staffRepository->getStaff($id);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Find staff success');
        } else {
            return $this->apiResponse([], 'fail', 'Find unsuccessful');
        }
    }

    public function storeStaff($request): \Illuminate\Http\JsonResponse
    {
        $fileImg=is_array($request->avatar);
        $avatar = ($fileImg )? Helper::saveImgBase64($request->avatar, 'Staff'):$request->avatar;
        $dataRequest = [
            'role_id' => $request->role_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatar,
            'status' => 1,
            'address' => $request->address,
            'created_date' => $request->created_date,
        ];
        $result = $this->staffRepository->storeStaff($dataRequest);

        if ($result) {
            return $this->apiResponse($result, 'success', 'Create staff successful');
        } else {
            return $this->apiResponse([], 'fail', 'Create staff unsuccessful');
        }
    }

    public function updateStaff($request, $id): \Illuminate\Http\JsonResponse
    {
        if (!is_null($request->avatar)) {
            $request['avatar'] = Helper::saveImgBase64($request->avatar, 'Staff');
        }
        $result = $this->staffRepository->updateStaff($request, $id);
        //return $this->apiResponse([],$result,'ÚUp');
        if ($result) {
            return $this->apiResponse($result, 'success', 'Update staff successfully');
        } else {
            return $this->apiResponse([], 'Fail', 'Update staff unsuccessful');
        }
    }

    public function deleteStaff($id)
    {
        $result = $this->staffRepository->deleteStaff($id);
        // return $this->apiResponse([],$id);
        if ($result) {
            return $this->apiResponse($result, 'Success', 'Delete staff successfully');
        } else {
            return $this->apiResponse([], 'Fail', 'Delete staff unsuccessful');
        }
    }

    public function getSearchStaff($request)
    {
        $result = $this->staffRepository->getSearchStaff($request);
        if ($result) {
            return $this->apiResponse($result, 'Success', 'Search staff successful');
        } else {
            return $this->apiResponse([], 'Fail', 'Search staff unsuccessful');
        }
    }
}
