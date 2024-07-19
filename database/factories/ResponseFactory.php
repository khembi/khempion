<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Response>
 */
class ResponseFactory extends Factory
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
            'question_id' => Question::factory(),
            'response' => fake()->sentence(),
            // 'meta' => $this->faker->optional()->json(),
        ];
    }
}
