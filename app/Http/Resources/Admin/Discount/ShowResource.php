<?php

namespace App\Http\Resources\Admin\Discount;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => (float)$this->value,
            'status' => $this->status == true ? 'Active' : 'InActive',
            'point' => (int)$this->point === 0 ? null : (int)$this->point,
            'description' => $this->description,
            'created_date' => $this->created_at,
        ];
    }
}
