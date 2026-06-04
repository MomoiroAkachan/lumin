<?php

namespace Database\Factories;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->words(4, true);

        return [
            'title' => Str::title($title),
            'slug' => Str::slug($title.'-'.fake()->unique()->numberBetween(1, 99999)),
            'cover_image_path' => 'https://picsum.photos/seed/portfolio'.fake()->unique()->numberBetween(1, 9999).'/800/500',
            'description' => fake()->paragraphs(2, true),
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
