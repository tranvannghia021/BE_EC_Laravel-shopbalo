<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        sleep(2);
        $customers = DB::table('customers')->limit(10)->get()->toArray();
        $staffs = DB::table('staff')->limit(10)->get()->toArray();
        $discounts = DB::table('discounts')->limit(10)->get()->toArray();
        $products = DB::table('products')->limit(10)->get()->toArray();

        $data = [
            [
                'id' => 1,
                'status' => 6,
                'total_price' => 7300,
                'created_order_date' =>  date('Y-m-01'),
                'order_detail' => []
            ],
            [
                'id' => 2,
                'status' => 6,
                'total_price' => 5600,
                'created_order_date' => date('Y-m-05'),
                'order_detail' => []
            ],
            [
                'id' => 3,
                'status' => 6,
                'total_price' => 3400,
                'created_order_date' => date('Y-m-09'),
                'order_detail' => []
            ], [
                'id' => 4,
                'status' => 6,
                'total_price' => 1200,
                'created_order_date' => date('Y-m-12'),
                'order_detail' => []
            ], [
                'id' => 5,
                'status' => 6,
                'total_price' => 5600,
                'created_order_date' => date('Y-m-16'),
                'order_detail' => []
            ], [
                'id' => 6,
                'status' => 6,
                'total_price' => 3800,
                'created_order_date' => date('Y-m-21'),
                'order_detail' => []
            ]
            , [
                'id' => 7,
                'status' => 6,
                'total_price' => 4300,
                'created_order_date' => date('Y-m-22'),
                'order_detail' => []
            ], [
                'id' => 8,
                'status' => 6,
                'total_price' => 4500,
                'created_order_date' => date('Y-m-16'),
                'order_detail' => []
            ]
            , [
                'id' => 9,
                'status' => 6,
                'total_price' => 5200,
                'created_order_date' => date('Y-m-19'),
                'order_detail' => []
            ], [
                'id' => 10,
                'status' => 6,
                'total_price' => 2500,
                'created_order_date' => date('Y-m-19'),
                'order_detail' => []
            ], [
                'id' => 11,
                'status' => 6,
                'total_price' => 3100,
                'created_order_date' => date('Y-m-05'),
                'order_detail' => []
            ], [
                'id' => 12,
                'status' => 6,
                'total_price' => 1500,
                'created_order_date' => date('Y-m-12'),
                'order_detail' => []
            ], [
                'id' => 13,
                'status' => 6,
                'total_price' => 2100,
                'created_order_date' => date('Y-m-12'),
                'order_detail' => []
            ], [
                'id' => 14,
                'status' => 6,
                'total_price' => 1900,
                'created_order_date' => date('Y-m-19'),
                'order_detail' => []
            ], [
                'id' => 15,
                'status' => 6,
                'total_price' => 5000,
                'created_order_date' => date('Y-m-18'),
                'order_detail' => []
            ], [
                'id' => 16,
                'status' => 6,
                'total_price' => 1200,
                'created_order_date' => date('Y-m-27'),
                'order_detail' => []
            ]
        ];

        if (!is_null($products)) {
            foreach ($products as $key => $item) {


                !isset($data[$key]['order_detail']) ? "" : array_push($data[$key]['order_detail'], empty($products[$key]->id) ? $products[0]->id : $products[$key]->id);
            }
        }
        $arr_staff=[1,2,3,4,5,6,7];
        $arr_products=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18];
        foreach ($data as $key => $item) {
            $id =  DB::table('orders')->insertGetId([
                'customer_id' =>Arr::random($arr_staff),// $customers[$key]->id,
                'staff_id' => Arr::random($arr_staff),// $staffs[$key]->id,
                'discount_id' => @$discounts[$key]->id ?? $discounts[0]->id,
                'status' => $item['status'],
                'discount_value' => @$discounts[$key]->value ?? $discounts[0]->value,
                'total_price' => $item['total_price'] * ($key + 1),
                'created_order_date' => $item['created_order_date'],
                'address_delivery'=>'HCM',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $count = $item['order_detail'] == [] ? 1 : count($item['order_detail']);

            foreach ($item['order_detail'] as $keyOrder => $orderDetail) {
                DB::table('order_details')->insert([
                    'order_id' => $id,
                    'product_id' => Arr::random($arr_products),//$keyOrder == 0 ? 1 : $keyOrder,
                    'amount' => 1,
                    'price' => ($item['total_price'] * ($key + 1)) / $count,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
