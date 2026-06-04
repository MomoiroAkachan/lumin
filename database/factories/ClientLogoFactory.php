<?php

namespace Database\Factories;

use App\Models\ClientLogo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClientLogo>
 */
class ClientLogoFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'logo_path' => 'https://picsum.photos/seed/logo'.fake()->unique()->numberBetween(1, 99999).'/200/100',
            'link' => fake()->optional()->url(),
            'position' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }
}
