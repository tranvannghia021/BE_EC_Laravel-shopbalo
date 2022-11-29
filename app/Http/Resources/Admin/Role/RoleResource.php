<?php

namespace App\Http\Resources\Admin\Role;

use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;


class RoleResource extends JsonResource
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array
    {

        $listPermissions =@$this->role_permissions->toArray();
        $arrayPermissionID=array();
        foreach($listPermissions as $item) {
            $obj = new stdClass();
            $obj->{"id"} = $item['permissions']['id'];
            $obj->{"name"} = $item['permissions']['name'];
                array_push($arrayPermissionID,(object)$obj);
        }
        $arrayData = [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'list_permissions' => $arrayPermissionID

        ];
        return $arrayData;
    }
}
