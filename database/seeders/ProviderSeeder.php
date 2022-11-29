<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            ['id' => 1, 'name' => 'Thinh Hoang Gia Company', 'address' => 'CuChi, HCM,VN', 'phone' => '0983403738', 'deleted_at' => null, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['id' => 2, 'name' => 'Hoang Nguyen Company', 'address' => 'Ninh Binh,VN', 'phone' => '0934863889', 'deleted_at' => null, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['id' => 3, 'name' => 'Dolo Fashin Company', 'address' => 'HaNoi,VN', 'phone' => '0988666674', 'deleted_at' => null, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],
            ['id' => 4, 'name' => 'MomoShop corp', 'address' => 'ToHienThanh,Q10,HCM,VN', 'phone' => '0988001040', 'deleted_at' => null, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null],


        ]);
    }
}
