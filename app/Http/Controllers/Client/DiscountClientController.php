<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Services\Client\DiscountClientService;
use Illuminate\Http\Request;

class DiscountClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $discountClientService;

    public function __construct(DiscountClientService $discountClientService)
    {
        $this->discountClientService = $discountClientService;
    }
    public function index(Request $request)
    {

        return $this->discountClientService->getAllDiscount($request);
    }
}
