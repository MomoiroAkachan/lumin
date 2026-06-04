<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Banner>
 */
class BannerFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'subtitle' => fake()->sentence(8),
            'image_path' => 'https://picsum.photos/seed/banner'.fake()->unique()->numberBetween(1, 9999).'/1600/700',
            'cta_label' => fake()->randomElement(['Saiba mais', 'Fale conosco', 'Veja agora']),
            'cta_url' => fake()->url(),
            'position' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }
}
