<?php

namespace App\Repositories\Admin;

use App\Http\Resources\Admin\Staff\StaffResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Staff;
use App\Repositories\BaseRepository;

class StatictisRepository extends BaseRepository
{
    protected $staff;
    protected $customers;
    protected $orders;
    protected $products;
    protected int $paginate = 8;
    public function __construct(Staff $staff,Order $order,Product $product, Customer $customer)
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
    public function getStaff(int $id)
    {
        $data = Staff::query()->with('roles')->find($id);
        return StaffResource::make($data)->response()->getData();
    }

}
