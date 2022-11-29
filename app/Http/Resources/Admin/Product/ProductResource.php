<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductResource extends JsonResource
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        $rating = [
            'point' => @$this->ratings->toArray()[0]['point_avg'] === null ? 5.00 : @$this->ratings->toArray()[0]['point_avg']
        ];
        $urlSlide='';
        if(strpos($this->image_slide,'http') ===false){
            $urlSlide= env('APP_URL') . '/storage/ProductSlide/'. $this->image_slide;
            $urlSlide=str_replace(',',','.env('APP_URL') . '/storage/ProductSlide/',$urlSlide);
        }else{
             $urlSlide=$this->image_slide;
        }
        $url= strpos($this->image,'http') ===false ? env('APP_URL') . '/storage/Product/' . $this->image: $this->image ;
       
        $arrayData = [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'category_name' => $this->categories->name,
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description,
            'image' => $url,
            'image_slide' => $urlSlide,
            'code_color' => $this->product_details->code_color ?? null,
            'amount' => $this->product_details->amount ?? null,
            'price' => $this->product_details->price ?? null,
            'ratings' => $rating

        ];
        return $arrayData;
    }
}
