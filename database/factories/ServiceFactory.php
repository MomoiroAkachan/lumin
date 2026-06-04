<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);

        return [
            'title' => Str::title($title),
            'slug' => Str::slug($title.'-'.fake()->unique()->numberBetween(1, 99999)),
            'icon' => fake()->randomElement(['cpu', 'cloud', 'shield', 'wrench', 'rocket']),
            'icon_path' => null,
            'short_description' => fake()->sentence(10),
            'full_text' => fake()->paragraphs(3, true),
            'position' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }
}
