<?php

namespace App\Services\Client;

use App\Http\Traits\ApiResponse;
use App\Repositories\Client\OrderClientRepositories;

class OrderClientService
{
    use ApiResponse;
    protected $oderRepositories;
    public function __construct(OrderClientRepositories $oderRepositories)
    {
        $this->oderRepositories = $oderRepositories;
    }
    public function getAllOrderByCustomer($request)
    {

        $result = $this->oderRepositories->getAllOrderByCustomer($request);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Get all order successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Get order unsuccessfuly');
        }
    }

    public function getOrderDetailById($request, $id)
    {
        if ($request->has('order_details')) {
            $result = $this->oderRepositories->getAllOrderDetailById($id);
            if ($result) {
                return $this->apiResponse($result, 'success', 'Get Order detail by id successfully');
            } else {
                return $this->apiResponse([], 'failed', 'Get Order detail by id unsuccessfully');
            }
        }
        // } else {
        //     $result = $this->oderRepositories->getOrderById($id);
        //     if ($result) {
        //         return $this->apiResponse($result, 'success', 'Get Order by id successfully');
        //     } else {
        //         return $this->apiResponse([], 'failed', 'Get Order by id unsuccessfully');
        //     }
        // }
    }
    public function store($request)
    {


        // dd($request);
        $result = $this->oderRepositories->storeOrder($request);


        if ($result) {
            return $this->apiResponse($result, 'success', 'Create order successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Create order unsuccessful');
        }
    }
}
