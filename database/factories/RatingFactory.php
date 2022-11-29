<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class RatingFactory extends Factory
{
    protected $model = Rating::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => 1,
            'product_id' => $this->faker->numberBetween(1, 10),
            'point' => $this->faker->numberBetween(1, 5),
            'content' => $this->faker->sentence($this->faker->biasedNumberBetween(4, 6)),
            'image' => 'test.jpg',
        ];
    }
}
