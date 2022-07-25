<?php

namespace Database\Factories;

use App\Models\CarProduct;
use App\Models\Mechanic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first(),
            'mechanic_id' => Mechanic::inRandomOrder()->first(),
            'car_product_id' => CarProduct::inRandomOrder()->first(),
            'description' => $this->faker->sentence(),
            'request_date' => now(),

        ];
    }
}
