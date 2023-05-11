<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dialog' => fake()->sentence(),
            'api_id' => 'fake_'.fake()->uuid(),
            'character_api_id' => 'fake_'.fake()->uuid(),
        ];
    }
}
