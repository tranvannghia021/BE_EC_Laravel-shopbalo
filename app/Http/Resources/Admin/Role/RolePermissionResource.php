<?php

namespace App\Http\Resources\Admin\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class RolePermissionResource extends JsonResource
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     */

    public function toArray($request): array
    {

        $permissions=@$this->permissions->toArray();
        $arrayPermissionName=array();
        foreach($permissions as $item) {
            array_push($arrayPermissionName,$item['name']);
        }
        $arrayData = [
           'role_id' => $this->role_id,
            'permission_id' => $this->permission_id,
            'permission_name' => $arrayPermissionName,

        ];
        return $arrayData;
    }
}
