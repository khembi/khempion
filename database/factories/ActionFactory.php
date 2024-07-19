<?php

namespace Database\Factories;

use App\Models\Response;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Action>
 */
class ActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'response_id' => Response::factory(),
            'action_type' => fake()->word(),
            'action' => fake()->sentence(),
            // 'meta' => $this->faker->optional()->json(),
        ];
    }
}
