<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role_company' => fake()->jobTitle().' - '.fake()->company(),
            'photo_path' => 'https://i.pravatar.cc/150?u='.fake()->unique()->uuid(),
            'content' => fake()->paragraph(),
            'rating' => fake()->numberBetween(3, 5),
            'position' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }
}
