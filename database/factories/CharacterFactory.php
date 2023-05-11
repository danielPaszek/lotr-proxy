<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    private const EXAMPLE_NAMES = ['Gandalf', 'Frodo Baggins', 'Bilbo Baggins', 'Fëanor'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => self::EXAMPLE_NAMES[fake()->numberBetween(0, 3)],
            'wiki_url' => 'fake_url',
            'race' => fake()->word(),
            'api_id' => 'fake_'.fake()->uuid(),
        ];
    }
}
