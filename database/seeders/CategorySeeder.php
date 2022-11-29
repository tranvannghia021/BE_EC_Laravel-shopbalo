<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Backpack',
                'parent_id' => 0,
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/02/balo-du-lich-quechua-n-hiking-30l-1-1-247x296.jpg',

            ],
            [
                'id' => 2,
                'name' => 'School Backpack',
                'parent_id' => 0,
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/cap-dung-laptop-cao-cap-tigernu-sore-giaolong--247x296.jpg',
            ],

            [

                'id' => 3,
                'name' => 'Laptop bag',
                'parent_id' => 0,
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-hang-hieu-mark-ryden-star-247x296.jpg',
            ],
            [
                'id' => 4,
                'name' => 'Men backpack',
                'parent_id' => 1,
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-kinck-balo-chong-nuoc-phong-cach-nam-tinh-7-247x296.jpg',
            ],
            [
                'id' => 5,
                'name' => 'Women\'s Backpack',
                'parent_id' => 1,
                'image' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-laptop-mikkor-royce-delux-red-1-247x296.jpg',
            ],

            [
                'id' => 6,
                'name' => 'Gift Backpacks',
                'parent_id' => 1,
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/tui-xach-thoi-trang-gia-re-william-polo-ox-giaolong-247x296.jpg',
            ],
            [
                'id' => 7,
                'name' => 'Travel Backpack',
                'parent_id' => 1,
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-kaka-hin-giaolong-247x296.jpg',
            ],

        ];


        foreach ($data as $item) {
            DB::table('categories')->insert([
                'name' => $item['name'],
                'parent_id' => $item['parent_id'],
                'image' => $item['image'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

    }
}
