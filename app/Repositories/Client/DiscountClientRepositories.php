<?php

namespace App\Repositories\Client;

use App\Http\Resources\Admin\Discount\GetAllResource;
use App\Models\Discount;

class DiscountClientRepositories
{
    protected  $discount;
    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return Discount
     */
    public function getAllDiscount($request)
    {
        $data = Discount::query()
            ->filter($request)
            ->orderBy('value', 'desc')
            ->get();
        return $data;
    }
}
