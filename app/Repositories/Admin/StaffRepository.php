<?php

namespace App\Repositories\Admin;

use App\Http\Resources\Admin\Staff\StaffResource;
use App\Models\Staff;
use App\Repositories\BaseRepository;

class StaffRepository extends BaseRepository
{
    protected $staff;
    protected int $paginate = 8;
    public function __construct(Staff $staff)
    {
        $this->staff =  $staff;
        parent::__construct($staff);
    }
    public function getAllStaff($request)
    {
        $data = Staff::query()
            ->with('roles')
            ->sort($request)
            ->search($request)
            ->filter($request)
            ->paginate($this->paginate);
        return StaffResource::collection($data)->response()->getData();
    }
    public function getUnique($request){
        $data = Staff::query()
            ->with('roles')
          ->existance($request)
            ->paginate($this->paginate);
        return StaffResource::collection($data)->response()->getData();
    }
    public function getStaff(int $id)
    {
        $data = Staff::query()->with('roles')->find($id);
        return StaffResource::make($data)->response()->getData();
    }
    public function storeStaff($request): \Illuminate\Database\Eloquent\Model|bool|\Illuminate\Database\Eloquent\Builder
    {

        try {
            $staff = Staff::query()->create($request);
            // return $request;
            /* $staff = Staff::query()->create([
                'role_id'=>$request->input('role_id'),
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'gender'=>$request->input('gender'),
                'phone'=>$request->input('phone'),
                'email'=>$request->input('email'),
                'password'=>bcrypt($request->input('password')),
                'avatar'=>$request->avatar,
                'status'=>1,
                'address'=> $request->input('address'),
                'created_date'=>$request->input('created_date'),
            ]);*/
        } catch (\Exception $e) {
            return false;
        }
        return $staff;
    }
    public function updateStaff($request, $id)
    {
        try {

            $staff =  Staff::query()->where('id', '=', $id)->first();
            $staff->update($request->all());
        } catch (\Exception $e) {
            return false;
        }
        return $staff;
    }
    public function deleteStaff($id)
    {
        try {
            $staff =  Staff::query()->where('id', '=', $id)->first();
            $staff->delete();
        } catch (\Exception $e) {
            return false;
        }
        return $staff;
    }

    public function getSearchStaff($request)
    {
        $query = Staff::query();
        if ($request->has('search') && !is_null($request->input('search')) && $request->has('searchFor')) {
            switch ($request->input('searchFor')) {
                case 'fullname':
                    $query = $query
                        ->where('first_name', 'like', '%' . $request->input('search') . '%')
                        ->orwhere('last_name', 'like', '%' . $request->input('search') . '%');
                    break;
                case 'email':
                    $query = $query->where('email', $request->input('search'));
                    break;
                case 'phone':
                    $query = $query->where('phone', $request->input('search'));
                    break;
                case 'id':
                    $query = $query->where('id', $request->input('search'));
                    break;
            }
        }
        if ($request->has('role_id') && $request->input('role_id') != -1) {
            $query = $query->where('role_id', $request->input('role_id'));
        }
        if ($request->has('status') && $request->input('status') != -1) {
            $query = $query->where('status', $request->input('status'));
        }
        //  dd($query);
        return $query->get();
    }
    public function getFilter($request)
    {
        $query = Staff::query();
        if ($request->has('role_id') && $request->input('role_id') != -1) {
            $query = $query->where('role_id', $request->input('role_id'));
        }
        if ($request->has('status') && $request->input('status') != -1) {
            $query = $query->where('status', $request->input('status'));
        }
        return $query->get();
    }
}
