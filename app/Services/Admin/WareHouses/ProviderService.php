<?php

namespace App\Services\Admin\WareHouses;

use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\WareHouses\ProviderRepository;

class ProviderService
{
    use apiResponse;
    protected ProviderRepository $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function getAllProvider($request)
    {

            $result = $this->providerRepository->getAllProvider($request);
            if ($result) {
                return $this->apiResponse($result, 'success', 'Get all provider successfully');
            } else {
                return $this->apiResponse([], 'fail', 'Get all provider unsuccessfuly');
            }



    }
}
