<?php

namespace Database\Factories;

use App\Models\CompanyQuality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CompanyQuality>
 */
class CompanyQualityFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'icon' => fake()->randomElement(['star', 'shield-check', 'clock', 'thumbs-up', 'award']),
            'icon_path' => null,
            'description' => fake()->paragraph(),
            'position' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }
}
