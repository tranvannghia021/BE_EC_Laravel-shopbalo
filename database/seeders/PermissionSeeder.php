<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
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
                'name' => 'DashBoard',
                'status' => true,
            ],
            [
                'id' => 2,
                'name' => 'Manage Category',
                'status' => true,
            ],
            [
                'id' => 3,
                'name' => 'Manage Product',
                'status' => true,
            ],
            [
                'id' => 4,
                'name' => 'Manage Promotion',
                'status' => true,
            ],
            [
                'id' => 5,
                'name' => 'Manage Order',
                'status' => true,
            ],
            [
                'id' => 6,
                'name' => 'Manage Staff',
                'status' => true,
            ],
            [
                'id' => 7,
                'name' => 'Manage Customer',
                'status' => true,
            ],
            [
                'id' => 8,
                'name' => 'Manage Review',
                'status' => true,
            ], [
                'id' => 9,
                'name' => 'Manage Decentralization',
                'status' => true,
            ], [
                'id' => 10,
                'name' => 'Manage Slider',
                'status' => true,
            ], [
                'id' => 11,
                'name' => 'Manage Storage DashBoard ',
                'status' => true,
            ], [
                'id' => 12,
                'name' => 'Manage Storage ',
                'status' => true,
            ], [
                'id' => 13,
                'name' => 'Manage Export Storage',
                'status' => true,
            ], [
                'id' => 14,
                'name' => 'Manage Import Storage',
                'status' => true,
            ],
            [
                'id' => 15,
                'name' => 'Manage Provider',
                'status' => true,
            ]


        ];
        foreach ($data as $item) {
            DB::table('permissions')->insert([
                'name' => $item['name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
