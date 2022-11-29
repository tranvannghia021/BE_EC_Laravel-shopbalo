<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            // after
            CategorySeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            CustomerSeeder::class,
            StaffSeeder::class,
            DiscountSeeder::class,
            ProductSeeder::class,
            //before
            SliderSeeder::class,
            RatingSeeder::class,
            OrderSeeder::class,
            ProviderSeeder::class,
            RolePermissionSeeder::class
        ]);
    }
}
