<?php

namespace App\Services\Admin;

use App\Helpers\Helper;
use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\RoleRespository;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Admin\StatictisRepository;

class RoleService
{
    use apiResponse;
    protected RoleRespository $RoleRepository;

    public function __construct(RoleRespository $RoleRepository)
    {
        $this->RoleRepository = $RoleRepository;
    }

    public function getAllRole($request)
    {

        $result = $this->RoleRepository->getAllRole($request);

        if ($result) {
            return $this->apiResponse($result, 'success', 'Get all Role success');
        } else {
            return $this->apiResponse([], 'fail', 'Get Role unsuccessful');
        }
    }

    public function getRoleById($id): \Illuminate\Http\JsonResponse
    {

        $result = $this->RoleRepository->getRoleById($id);

        if ($result) {
            return $this->apiResponse($result, 'success', 'Get  Role success');
        } else {
            return $this->apiResponse([], 'fail', 'Get Role unsuccessful');
        }
    }


    public function storeRole($request): \Illuminate\Http\JsonResponse
    {


       $result= $this->RoleRepository->storeRole($request);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Create Role successful');
        } else {
            return $this->apiResponse([], 'fail', 'Create Role unsuccessful');
        }
    }

    public function updateRole($request, $id): \Illuminate\Http\JsonResponse
    {
        $result = $this->RoleRepository->updateRole($request, $id);
        //return $this->apiResponse([],$result,'ÚUp');
        if ($result) {
            return $this->apiResponse($result, 'success', 'Update Role successfully');
        } else {
            return $this->apiResponse([], 'Fail', 'Update Role unsuccessful');
        }
    }

    public function deleteRole($id)
    {
        $result = $this->RoleRepository->deleteRole($id);
        // return $this->apiResponse([],$id);
        if ($result) {
            return $this->apiResponse($result, 'Success', 'Delete Role successfully');
        } else {
            return $this->apiResponse([], 'Fail', 'Delete Role unsuccessful');
        }
    }


}
