<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'url' => fake()->slug,
            'short_description' => fake()->text(50),
            'full_description' => fake()->text(300),
            'created_at' => fake()->dateTime,
            'status' => (int) fake()->boolean,
        ];
    }
}
