<?php

namespace App\Services\Client;

use App\Http\Traits\ApiResponse;
use App\Repositories\Client\DiscountClientRepositories;

class DiscountClientService
{
    use ApiResponse;
    protected $discountRepositories;
   public function __construct(DiscountClientRepositories $discountRepositories ){
       $this->discountRepositories=$discountRepositories;
   }

   public function getAllDiscount($request){

       $result = $this->discountRepositories->getAllDiscount($request);
       if ($result) {
           return $this->apiResponse($result, 'success', 'Get all discount successfully');
       } else {
           return $this->apiResponse([], 'fail', 'Get discount unsuccessfuly');
       }
   }
}
