<?php

namespace App\Http\Resources\Admin\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        $url= strpos( $this->products->image,'http') ===false ?  env('APP_URL') . '/storage/product/' .  $this->products->image :  $this->products->image ;

        $arrOrderDetail = [
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'product_name' => $this->products->name,
            'image' => $url,
            'amount' => $this->amount,
            'price' => $this->price,

        ];
        return $arrOrderDetail;
    }
}
