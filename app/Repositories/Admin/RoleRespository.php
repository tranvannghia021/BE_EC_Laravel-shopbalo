<?php

namespace App\Repositories\Admin;

use App\Http\Resources\Admin\Role\RoleResource;
use App\Models\Role;
use App\Models\RolePermission;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleRespository extends BaseRepository
{
    protected $Role;
    protected int $paginate = 15;
    public function __construct(Role $Role)
    {
        $this->Role =  $Role;
        parent::__construct($Role);
    }
    public function getAllRole($request)
    {
        try {
            $data = Role::query()
                ->with('role_permissions', function ($query) {
                    $query->with('permissions');
                })
                ->sort($request)
                ->search($request)
                ->filter($request)
                ->paginate($this->paginate);
            //  dd($data);

        } catch (\Exception $e) {
            dd($e);
        }
        return RoleResource::collection($data)->response()->getData();
    }
    public function getRoleById(int $id)
    {

        try {
            $data = Role::query()
                ->with('role_permissions', function ($query) {
                    $query->with('permissions');
                })
                ->find($id);
            return RoleResource::make($data)->response()->getData();
        } catch (\Exception $e) {
            dd($e);
            return false;
        }
    }


    public function storeRole($request): \Illuminate\Database\Eloquent\Builder|string
    {

        try {
            $listPermissions = $request->listPermissions;
            $data = Role::query()->create([
                'name' => $request->input('name'),
                'status' => 'Active',
            ]);
            // dd($data['id']);
            foreach ($listPermissions as $item) {
                // dd($item);
                $result =  RolePermission::query()->create([
                    'role_id' => $data['id'],
                    'permission_id' =>  $item['permission_id']
                ]);
            }
        } catch (\Exception $e) {

            return false;
        }
        return  $result;
    }
    public function updateRole($request, $id)
    {
        DB::beginTransaction();
        try {
            $Role = Role::query()->where('id', '=', $id)->first();
            $Role->update($request->all());

            $listPermissions = $request->listPermissions;
            //xoa
            $list = RolePermission::query()->where('role_id', '=', $id)->delete();
            //insert
            foreach ($listPermissions as $item) {
                $result = RolePermission::query()->create([
                    'role_id' => $id,
                    'permission_id' => $item['permission_id']
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            // dd($e);
            DB::rollBack();
            return false;
        }
        return $Role;
    }
    public function deleteRole($id)
    {
        DB::beginTransaction();
        try {
            $Role =  Role::query()->where('id', '=', $id)->first();
            $list = RolePermission::query()->where('role_id', $id)->delete();
            $Role->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
        return $Role;
    }
}
