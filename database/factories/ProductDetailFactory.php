<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        DB::table('product_details')->insert([
            ['id' => 1, 'product_id' => 1, 'code_color' => '#ffe00', 'amount' => 20, 'price' => 350000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'product_id' => 2, 'code_color' => '#ffe00', 'amount' => 30, 'price' => 550000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 3, 'product_id' => 3, 'code_color' => '#ffe00', 'amount' => 20, 'price' => 450000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 4, 'product_id' => 4, 'code_color' => '#efe00', 'amount' => 10, 'price' => 150000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 5, 'product_id' => 5, 'code_color' => '#sae00', 'amount' => 20, 'price' => 350000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 6, 'product_id' => 6, 'code_color' => '#ffe00', 'amount' => 20, 'price' => 350000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 7, 'product_id' => 7, 'code_color' => '#ffe00', 'amount' => 30, 'price' => 550000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 8, 'product_id' => 8, 'code_color' => '#ffe00', 'amount' => 20, 'price' => 450000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 9, 'product_id' => 9, 'code_color' => '#efe00', 'amount' => 10, 'price' => 150000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 10, 'product_id' => 10, 'code_color' => '#sae00', 'amount' => 20, 'price' => 350000, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

        ]);
    }
}
