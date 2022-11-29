<?php

namespace App\Http\Resources\Admin\Permission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class PermissionResource extends JsonResource
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        $arrayData = [
            'id' => $this->id,
            'name' => $this->name,
            //   'status' => $this->status,
            //  'description' => $this->description,

        ];
        return $arrayData;
    }
}
