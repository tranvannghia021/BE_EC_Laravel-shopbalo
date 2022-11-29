<?php

namespace App\Services\Admin;

use App\Helpers\Helper;
use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\PermissionRepository;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Admin\StatictisRepository;

class PermissionService
{
    use apiResponse;
    protected PermissionRepository $PermissionRepository;

    public function __construct(PermissionRepository $PermissionRepository)
    {
        $this->PermissionRepository = $PermissionRepository;
    }

    public function getAllPermission($request): \Illuminate\Http\JsonResponse
    {
        $result = $this->PermissionRepository->getAllPermission($request);

        if ($result) {
            return $this->apiResponse($result, 'success', 'Get all Permission success');
        } else {
            return $this->apiResponse([], 'fail', 'Get Permission unsuccessful');
        }
    }


//    public function storePermission($request): \Illuminate\Http\JsonResponse
//    {
//
//        $result = $this->PermissionRepository->storePermission($request);
//
//
//        if ($result) {
//            return $this->apiResponse($result, 'success', 'Create Permission successful');
//        } else {
//            return $this->apiResponse([], 'fail', 'Create Permission unsuccessful');
//        }
//    }
//
//    public function updatePermission($request, $id): \Illuminate\Http\JsonResponse
//    {
//        $result = $this->PermissionRepository->updatePermission($request, $id);
//        //return $this->apiResponse([],$result,'ÚUp');
//        if ($result) {
//            return $this->apiResponse($result, 'success', 'Update Permission successfully');
//        } else {
//            return $this->apiResponse([], 'Fail', 'Update Permission unsuccessful');
//        }
//    }
//
//    public function deletePermission($id)
//    {
//        $result = $this->PermissionRepository->deletePermission($id);
//        // return $this->apiResponse([],$id);
//        if ($result) {
//            return $this->apiResponse($result, 'Success', 'Delete Permission successfully');
//        } else {
//            return $this->apiResponse([], 'Fail', 'Delete Permission unsuccessful');
//        }
//    }


}
