<?php

namespace Database\Factories;

use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortfolioImage>
 */
class PortfolioImageFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'portfolio_id' => Portfolio::factory(),
            'image_path' => 'https://picsum.photos/seed/portfolio-img'.fake()->unique()->numberBetween(1, 99999).'/600/400',
            'caption' => fake()->optional()->sentence(),
            'position' => fake()->numberBetween(0, 10),
        ];
    }
}
