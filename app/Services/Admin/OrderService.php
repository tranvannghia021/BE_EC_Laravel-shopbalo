<?php

namespace App\Services\Admin;

use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\OrderRepository;
use Exception;
use function PHPUnit\Framework\isEmpty;

class OrderService
{
    use ApiResponse;
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function getAllOrder($request)
    {
        $result = $this->orderRepository->getAllOrder($request);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Get Order successfully');
        } else {
            return $this->apiResponse([], 'failed', 'Get Order unsuccessfully');
        }
    }
    public function getOrderDetailById($request, $id)
    {
        if ($request->has('order_details')) {
            $result = $this->orderRepository->getOrderDetailById($id);
            if ($result) {
                return $this->apiResponse($result, 'success', 'Get Order detail by id successfully');
            } else {
                return $this->apiResponse([], 'failed', 'Get Order detail by id unsuccessfully');
            }
        } else {
            $result = $this->orderRepository->getOrderById($id);
            if ($result) {
                return $this->apiResponse($result, 'success', 'Get Order by id successfully');
            } else {
                return $this->apiResponse([], 'failed', 'Get Order by id unsuccessfully');
            }
        }
    }
    public function updateOrder($request, $id)
    {
        if (is_null($id)) throw new Exception();;
        $result = $this->orderRepository->updateOrder($request, $id);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Order updated successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Update Order unsuccessfully');
        }
    }
    /*----------------------------------------------------------------Summary----------------------------------------------------------------*/
    public function getFigureOrderToday(): \Illuminate\Http\JsonResponse
    {
        $result = $this->orderRepository->getOrderToday();
        $data = [

            'data' => $result
        ];
        if ($result) {
            return $this->apiResponse($data, 'success', 'Figure Order today successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Figure Order today unsuccessfully');
        }
    }
    public function getFigureRevenueToday(): \Illuminate\Http\JsonResponse
    {
        $result = $this->orderRepository->getRevenueToday();
        $data = [

            'data' => $result
        ];
        if ($result) {
            return $this->apiResponse($data, 'success', 'Figure Order today successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Figure Order today unsuccessfully');
        }
    }


    /*----------------------------------------------------------------Chart----------------------------------------------------------------*/
    public function getFigureOrders($request): \Illuminate\Http\JsonResponse
    {

        $result = $this->orderRepository->getFigureOrders($request);
        if (!$result) $result = [];
        $data = [
            'data' => $result
        ];

        return $this->apiResponse($data, 'success', 'Figure Order successfully');
    }
    public function getFigureRevenue($request): \Illuminate\Http\JsonResponse
    {

        $result = $this->orderRepository->getFigureRevenue($request);
        $data = [

            'data' => $result
        ];

        return $this->apiResponse($data, 'success', 'Figure Order successfully');
    }
    public function getTopStaffSelling($request): \Illuminate\Http\JsonResponse
    {

        $result = $this->orderRepository->getFigureStaffSelling($request);
        $data = [

            'data' => $result
        ];
        if ($result) {
            return $this->apiResponse($data, 'success', 'Figure Order successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Figure Order unsuccessfully');
        }
    }
    public function getTopCustomerBuying($request): \Illuminate\Http\JsonResponse
    {

        $result = $this->orderRepository->getFigureCustomerBuying($request);
        $data = [

            'data' => $result
        ];
        if ($result) {
            return $this->apiResponse($data, 'success', 'Figure Order successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Figure Order unsuccessfully');
        }
    }
    public function getFigureCategorySelling($request): \Illuminate\Http\JsonResponse
    {

        $result = $this->orderRepository->getFigureCategorySelling($request);
        $data = [

            'data' => $result
        ];
        if ($result) {
            return $this->apiResponse($data, 'success', 'Figure Order successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Figure Order unsuccessfully');
        }
    }

    public function store($request)
    {
        // dd($request);
        $result = $this->orderRepository->storeOrder($request);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Create order successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Create order unsuccessful');
        }
    }
}
