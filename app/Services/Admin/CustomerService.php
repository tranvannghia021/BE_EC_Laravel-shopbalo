<?php

namespace App\Services\Admin;

use App\Helpers\Helper;
use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\CustomerRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Date;

class CustomerService
{
    use apiResponse;
    protected CustomerRepository $CustomerRepository;

    public function __construct(CustomerRepository $CustomerRepository)
    {
        $this->CustomerRepository = $CustomerRepository;
    }

    public function getAllCustomer($request): JsonResponse
    {

        $result = $this->CustomerRepository->getAllCustomer($request);
        // return $this->apiResponse([],'sending',$result);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Get all Customer success');
        } else {
            return $this->apiResponse([], 'fail', 'Get Customer unsuccessful');
        }
    }
    public function getFigureNewCustomer(): JsonResponse
    {
        $result = $this->CustomerRepository->getNewCustomerToday();
        $data = [

            'data' => $result
        ];
        if ($result) {
            return $this->apiResponse($data, 'success', 'Figure Order today successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Figure Order today unsuccessfully');
        }
    }

    public function  showCustomer($id)
    {
        $result = $this->CustomerRepository->getCustomer($id);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Find Customer success');
        } else {
            return $this->apiResponse([], 'fail', 'Find unsuccessful');
        }
    }

    public function storeCustomer($request): JsonResponse
    {
        // return $this->apiResponse('','testing',$request->all());
        $fileImg=is_array($request->avatar);
        $avatar = ($fileImg )? Helper::saveImgBase64($request->avatar, 'Customer'):$request->avatar;
        $dataRequest = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'point' => $request->point,
            'avatar' => $avatar, //'abcd.png'
            'status' => 1,
            'address' => $request->address,
            'created_date' => date('Y-m-d H:i:s'),
        ];

        $result = $this->CustomerRepository->storeCustomer($dataRequest);
        //  return $this->apiResponse('','fail',$result);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Create Customer successful');
        } else {
            return $this->apiResponse([], 'fail', 'Create Customer unsuccessful');
        }
    }

    public function updateCustomer($request, $id): JsonResponse
    {
        if (!is_null($request->avatar)) {
            $request['avatar'] = Helper::saveImgBase64($request->avatar, 'Customer');
        }
        /*if(!is_null($request->created_date)) {
            $request['created_date'] = date('Y-m-d' , strtotime($request->created_date));
        }*/
        $result = $this->CustomerRepository->updateCustomer($request, $id);
        //return $this->apiResponse([],$result,'ÚUp');
        if ($result) {
            return $this->apiResponse($result, 'success', 'Update Customer successfully');
        } else {
            return $this->apiResponse([], 'Fail', 'Update Customer unsuccessful');
        }
    }

    public function deleteCustomer($id)
    {
        $result = $this->CustomerRepository->deleteCustomer($id);
        if ($result) {
            return $this->apiResponse($result, 'Success', 'Delete Customer successfully');
        } else {
            return $this->apiResponse([], 'Fail', 'Delete Customer unsuccessful');
        }
    }
}
