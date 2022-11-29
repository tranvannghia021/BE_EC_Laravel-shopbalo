<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        sleep(1);
        $products=DB::table('products')->get()->toArray();
        $data=[
                [
                    'id'=>1,
                    'point'=>4,
                    'status'=>'pushlished',
                    'content'=>'I like it very much, next time will visit the shop! Nice bag but the price is super cheap and the delivery is fast too, I\'m in love with it'
                ],
                [
                    'id'=>2,
                    'point'=>5,
                    'status'=>'pushlished',
                    'content'=>'Received the product, packed carefully, fast delivery, delivered the right product, enough quantity, color as in the order I ordered, the price is also reasonable, I am very satisfied, next time I will definitely continue Continue to support the shop, please give the shop 10 stars..!'
                ],
                [
                    'id'=>3,
                    'point'=>5,
                    'status'=>'pushlished',
                    'content'=>'Balloon is so pretty
                    Shop cskh is very goodttttttttttt
                    5 stars '
                ],
                [
                    'id'=>4,
                    'point'=>5,
                    'status'=>'pushlished',
                    'content'=>'The bag is so pretty everyone..........everyone should buy it.........'
                ],
                [
                    'id'=>5,
                    'point'=>5,
                    'status'=>'pushlished',
                    'content'=>'Nice bag, nice leather, no bad smell. beautiful color like the photo. ..............................'
                ]
        ];
        foreach($data as $key=> $item){
            DB::table('ratings')->insert([
                'customer_id'=>Customer::all()->random()->id,
                'product_id'=>$products[$key]->id,
                'point'=>$item['point'],
                'status'=>$item['status'],
                'content'=>$item['content'],
                'image'=>$products[$key]->image,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
