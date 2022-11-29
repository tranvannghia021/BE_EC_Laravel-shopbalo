<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Staff;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    protected $model = Staff::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'role_id' => Role::all()->random()->id, //$this->faker->randomElement([1,2,3]),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElements(['male', 'female'])[0],
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('12345678910'),
            'avatar' => $this->faker->imageUrl,
            'status' => 1,
            'address' => $this->faker->address,
            'created_date' => date('Y-m-d H:i:s'),
            'created_at' =>     date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),


        ];
    }
}
