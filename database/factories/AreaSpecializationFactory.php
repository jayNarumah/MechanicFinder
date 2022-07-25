<?php

namespace Database\Factories;

use App\Models\CarProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\SpecializationArea;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AreaSpecialization>
 */
class AreaSpecializationFactory extends Factory
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
            'specialization_area_id' => SpecializationArea::inRandomOrder()->first(),
            'car_product_id' => CarProduct::inRandomOrder()->first(),
        ];
    }
}
