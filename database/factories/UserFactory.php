<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_type_id' => UserType::inRandomOrder()->first(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique->safeEmail(),
            'phone_number' => '07066352444',
            'password' => bcrypt('password'),
            'image' => 'image path',
        ];
    }
}
