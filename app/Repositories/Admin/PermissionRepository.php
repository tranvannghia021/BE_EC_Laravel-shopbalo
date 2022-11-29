<?php

namespace App\Repositories\Admin;

use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Models\Permission;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class PermissionRepository extends BaseRepository
{
    protected $Permission;
    protected int $paginate = 15;
    public function __construct(Permission $Permission)
    {
        $this->Permission =  $Permission;
        parent::__construct($Permission);
    }
    public function getAllPermission($request)
    {
        try {
            $data = Permission::query()
                ->paginate($this->paginate);

        }
        catch (\Exception $e) {
           // dd($e);
            return false;
        }
        return PermissionResource::collection($data)->response()->getData();
    }


//    public function storePermission($request): \Illuminate\Database\Eloquent\Builder|string
//    {
//
//        $query = Permission::query();
//        try {
//            $query=$query->create($request)->toSql();
//
//        } catch (\Exception $e) {
//            // dd($e);
//            return false;
//        }
//        //  dd($Permission);;
//        // dd($query);
//        return $query;
//    }
//    public function updatePermission($request, $id)
//    {
//
//        $Permission =  Permission::query()->where('id', '=', $id)->first();
//        $Permission->update($request->all());
//        return $Permission;
//    }
//    public function deletePermission($id)
//    {
//        try {
//            $Permission =  Permission::query()->where('id', '=', $id)->first();
//            $Permission->delete();
//        } catch (\Exception $e) {
//            return false;
//        }
//        return $Permission;
//    }
}
