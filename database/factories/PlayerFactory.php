<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'birth_date' => $this->faker->date(),
            'nationality' => $this->faker->country(),
            'alias' => $this->faker->word(),
            'picture' => $this->faker->imageUrl(640, 480, 'people', true, 'Player Picture'),
            'created_at' => now(),
        ];
    }
}
