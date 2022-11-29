<?php

namespace Database\Seeders;

use App\Models\Discount;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'id'=>1,
                'name'=>'Sale 50%',
                'value'=>50,
                'status'=>true,
                'point'=>5,
                'description'=>'Only valid from October 20 to November 20 in 2022.'
            ],
            [
                'id'=>2,
                'name'=>'Buy one get one free',
                'value'=>0,
                'status'=>true,
                'point'=>5,
                'description'=>'Only applicable for products with a value of 200,000 VND or more.'
            ],
            [
                'id'=>3,
                'name'=>'Discounts for a certain group of special audiences',
                'value'=>30,
                'status'=>true,
                'point'=>5,
                'description'=>'Only applicable for products with a value of less than 100,000 VND.'
            ],
            [
                'id'=>4,
                'name'=>'Flash sale',
                'value'=>70,
                'status'=>true,
                'point'=>5,
                'description'=>'Only applied in the following time frames from 9am-12pm, 16h-18h, Note: This promotion is only used on December 25, 2022.'
            ],
            [
                'id'=>5,
                'name'=>'Free shipping and free returns (exchanges)',
                'value'=>10,
                'status'=>true,
                'point'=>15,
                'description'=>'Only applicable for payment services via MoMo, ZaloPay, Paypal, Amazon Pay.'
            ],
        ];
        foreach($data as $item){

            DB::table('discounts')->insert([
                'name' => $item['name'],
                'value' =>  $item['value'],
                'status' =>  $item['status'],
                'point' =>  $item['point'],
                'description' =>  $item['description'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
